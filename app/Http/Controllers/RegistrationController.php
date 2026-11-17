<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class RegistrationController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');
    }

    public function store(Request $request, Workshop $workshop)
    {
        $user = $request->user();

        // 1. Validasi: Jangan biarkan panitia mendaftar workshop (role separation)
        if ($user->isPanitia()) {
            return back()->with('error', 'Akun panitia tidak dapat mendaftar workshop peserta.');
        }

        // 2. Validasi LKPD: Mencegah pendaftaran ganda
        $existing = Registration::where('user_id', $user->id)
            ->where('workshop_id', $workshop->id)
            ->first();

        if ($existing) {
            if ($existing->payment_status === 'paid') {
                return redirect()->route('registrations.show', $existing)
                    ->with('info', 'Kamu sudah terdaftar dan tiket sudah aktif.');
            }
            return redirect()->route('registrations.pay', $existing)
                ->with('info', 'Kamu sudah memiliki tagihan pendaftaran untuk workshop ini. Silakan selesaikan pembayaran.');
        }

        // 3. Validasi Kuota
        if ($workshop->remaining_quota <= 0) {
            return back()->with('error', 'Maaf, kuota peserta untuk workshop ini sudah penuh.');
        }

        // 4. Generate order ID unik
        $orderId = 'WKTX-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        $registration = Registration::create([
            'user_id' => $user->id,
            'workshop_id' => $workshop->id,
            'order_id' => $orderId,
            'amount' => $workshop->price,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('registrations.pay', $registration);
    }

    public function pay(Registration $registration)
    {
        // Otorisasi: Peserta hanya bisa melihat pendaftaran miliknya
        if (auth()->id() !== $registration->user_id && !auth()->user()->isPanitia()) {
            abort(403, 'Kamu tidak memiliki akses ke tiket / pendaftaran ini.');
        }

        if ($registration->payment_status === 'paid') {
            return redirect()->route('registrations.show', $registration);
        }

        // Inisialisasi Snap Token Midtrans jika belum ada
        if (!$registration->snap_token) {
            try {
                $params = [
                    'transaction_details' => [
                        'order_id' => $registration->order_id,
                        'gross_amount' => (int) $registration->amount,
                    ],
                    'customer_details' => [
                        'first_name' => $registration->user->name,
                        'email' => $registration->user->email,
                    ],
                    'item_details' => [
                        [
                            'id' => 'WS-' . $registration->workshop->id,
                            'price' => (int) $registration->amount,
                            'quantity' => 1,
                            'name' => Str::limit($registration->workshop->title, 40),
                        ]
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);
                $registration->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                // Fallback jika API key belum diisi / simulator lokal
                $registration->update(['snap_token' => 'SIMULATOR-TOKEN-' . Str::random(16)]);
            }
        }

        return view('registrations.pay', compact('registration'));
    }

    // Simulasi atau webhook penyelesaian pembayaran Midtrans Sandbox
    public function simulateSuccess(Request $request, Registration $registration)
    {
        if (auth()->id() !== $registration->user_id && !auth()->user()->isPanitia()) {
            abort(403);
        }

        if ($registration->payment_status !== 'paid') {
            $ticketCode = 'TIX-' . strtoupper(Str::random(4)) . '-' . date('dmy') . '-' . $registration->id;
            $registration->update([
                'payment_status' => 'paid',
                'ticket_code' => $ticketCode,
                'paid_at' => now(),
            ]);
        }

        return redirect()->route('registrations.show', $registration)
            ->with('success', 'Pembayaran berhasil diverifikasi! Tiket digitalmu telah terbit.');
    }

    // Halaman Tiket Digital (DICE / Fever style)
    public function show(Registration $registration)
    {
        // LKPD: Peserta hanya bisa membuka tiket miliknya; tampilkan tiket hanya setelah lunas
        if (auth()->id() !== $registration->user_id && !auth()->user()->isPanitia()) {
            abort(403, 'Kamu tidak memiliki akses ke tiket ini.');
        }

        if ($registration->payment_status !== 'paid') {
            return redirect()->route('registrations.pay', $registration)
                ->with('error', 'Tiket digital hanya dapat diakses setelah pembayaran berstatus LUNAS.');
        }

        $registration->load(['user', 'workshop']);

        return view('registrations.show', compact('registration'));
    }

    // Daftar tiket milik user yang login
    public function myTickets()
    {
        $registrations = auth()->user()->registrations()
            ->with('workshop')
            ->latest()
            ->get();

        return view('registrations.my-tickets', compact('registrations'));
    }
}
