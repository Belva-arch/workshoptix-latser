@extends('layouts.app')

@section('title', 'Pembayaran Midtrans #' . $registration->order_id . ' — WORKSHOPTIX')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6">
        <a href="{{ route('workshops.show', $registration->workshop->slug) }}" class="hover:text-white transition-colors">Workshop</a>
        <span>/</span>
        <span class="text-blue-400">Checkout & Payment Gateway</span>
        <span>/</span>
        <span class="text-slate-300 font-mono">{{ $registration->order_id }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Kolom Kiri: Rincian Order (4 Kolom) -->
        <div class="lg:col-span-5 space-y-5">
            <div class="p-6 rounded-3xl bg-[#0f172a] border border-[#E2E8F0]/15 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-[#E2E8F0]/10">
                    <span class="text-xs font-mono uppercase text-slate-400">Order ID</span>
                    <span class="text-xs font-mono font-bold text-blue-400">{{ $registration->order_id }}</span>
                </div>

                <div class="py-4 border-b border-[#E2E8F0]/10 space-y-2">
                    <span class="text-xs font-mono uppercase text-slate-400 block">Workshop IT</span>
                    <h3 class="text-sm font-bold text-white leading-snug">{{ $registration->workshop->title }}</h3>
                    <div class="text-xs text-slate-400 font-mono space-y-0.5 pt-1">
                        <div>📅 {{ $registration->workshop->start_time->isoFormat('D MMM Y • HH:mm') }} WIB</div>
                        <div>📍 {{ $registration->workshop->location }}</div>
                    </div>
                </div>

                <div class="py-4 border-b border-[#E2E8F0]/10">
                    <span class="text-xs font-mono uppercase text-slate-400 block mb-1">Peserta Terdaftar</span>
                    <div class="text-xs font-semibold text-white">{{ $registration->user->name }}</div>
                    <div class="text-[11px] text-slate-400 font-mono">{{ $registration->user->email }}</div>
                </div>

                <div class="pt-4 flex items-center justify-between">
                    <span class="text-xs text-slate-300 font-medium">Total Pembayaran</span>
                    <span class="text-xl font-extrabold text-white font-mono">
                        Rp {{ number_format($registration->amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <!-- Midtrans Security Badge -->
            <div class="p-4 rounded-2xl bg-[#0B1220]/80 border border-[#E2E8F0]/10 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="text-[11px] text-slate-400 leading-tight">
                    <strong class="text-white block">Midtrans Payment Gateway</strong>
                    Terenkripsi 256-bit SSL & terverifikasi Bank Indonesia.
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Antarmuka Pilihan Metode Pembayaran Midtrans (7 Kolom) -->
        <div class="lg:col-span-7">
            <div class="p-6 sm:p-8 rounded-3xl bg-[#0f172a] border border-[#E2E8F0]/15 shadow-2xl relative">
                <div class="flex items-center justify-between pb-5 border-b border-[#E2E8F0]/10">
                    <div>
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <span>Pilih Metode Pembayaran</span>
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5 font-mono">Pilih saluran pembayaran resmi yang kamu inginkan</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold bg-blue-500/15 text-blue-300 border border-blue-500/30">
                        MIDTRANS SANDBOX
                    </span>
                </div>

                <!-- Accordion / Tabs Metode Pembayaran -->
                <div class="mt-6 space-y-4">
                    
                    <!-- 1. E-Wallet & QRIS (Gopay, ShopeePay, Dana, QRIS) -->
                    <div class="rounded-2xl border border-[#E2E8F0]/10 bg-[#0B1220]/70 overflow-hidden">
                        <button type="button" onclick="toggleSection('sec-ewallet')" class="w-full p-4 text-left flex items-center justify-between hover:bg-slate-800/40 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xs">
                                    QR
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-white block">E-Wallet & QRIS Instan</span>
                                    <span class="text-[11px] text-slate-400">GoPay, QRIS (BCA Mobile, Livin, Dana, OVO, ShopeePay)</span>
                                </div>
                            </div>
                            <span class="text-slate-400 text-xs">▼</span>
                        </button>
                        
                        <div id="sec-ewallet" class="p-4 pt-0 border-t border-[#E2E8F0]/5 space-y-3">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-3">
                                <div onclick="selectMethod('QRIS / GoPay', 'qris')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-center transition-all">
                                    <div class="font-black text-xs text-white">QRIS</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Semua E-Wallet</div>
                                </div>
                                <div onclick="selectMethod('GoPay', 'gopay')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-center transition-all">
                                    <div class="font-bold text-xs text-emerald-400">GoPay</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">App / QR</div>
                                </div>
                                <div onclick="selectMethod('ShopeePay', 'shopeepay')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-center transition-all">
                                    <div class="font-bold text-xs text-amber-500">ShopeePay</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">App / QR</div>
                                </div>
                                <div onclick="selectMethod('DANA', 'dana')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-center transition-all">
                                    <div class="font-bold text-xs text-blue-400">DANA</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Scan QRIS</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Virtual Account / E-Banking (BCA, Mandiri, BNI, BRI, Permata) -->
                    <div class="rounded-2xl border border-[#E2E8F0]/10 bg-[#0B1220]/70 overflow-hidden">
                        <button type="button" onclick="toggleSection('sec-va')" class="w-full p-4 text-left flex items-center justify-between hover:bg-slate-800/40 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-xs">
                                    VA
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-white block">Virtual Account (E-Banking & ATM)</span>
                                    <span class="text-[11px] text-slate-400">Verifikasi otomatis tanpa perlu upload bukti transfer</span>
                                </div>
                            </div>
                            <span class="text-slate-400 text-xs">▼</span>
                        </button>
                        
                        <div id="sec-va" class="p-4 pt-0 border-t border-[#E2E8F0]/5 space-y-2">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 pt-3">
                                <div onclick="selectMethod('BCA Virtual Account', 'bca_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">BCA VA</div>
                                    <div class="text-[10px] text-slate-400">m-BCA, KlikBCA</div>
                                </div>
                                <div onclick="selectMethod('Mandiri Bill Payment', 'mandiri_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">Mandiri Bill</div>
                                    <div class="text-[10px] text-slate-400">Livin' Mandiri</div>
                                </div>
                                <div onclick="selectMethod('BNI Virtual Account', 'bni_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">BNI VA</div>
                                    <div class="text-[10px] text-slate-400">BNI Mobile</div>
                                </div>
                                <div onclick="selectMethod('BRI Virtual Account (BRIVA)', 'bri_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">BRIVA</div>
                                    <div class="text-[10px] text-slate-400">BRImo</div>
                                </div>
                                <div onclick="selectMethod('Permata VA', 'permata_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">Permata VA</div>
                                    <div class="text-[10px] text-slate-400">PermataNet</div>
                                </div>
                                <div onclick="selectMethod('CIMB Niaga VA', 'cimb_va')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">CIMB VA</div>
                                    <div class="text-[10px] text-slate-400">OCTO Mobile</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Kartu Kredit / Debit Online -->
                    <div class="rounded-2xl border border-[#E2E8F0]/10 bg-[#0B1220]/70 overflow-hidden">
                        <button type="button" onclick="toggleSection('sec-cc')" class="w-full p-4 text-left flex items-center justify-between hover:bg-slate-800/40 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-xs">
                                    CC
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-white block">Kartu Kredit / Debit Visa & MasterCard</span>
                                    <span class="text-[11px] text-slate-400">Visa, Mastercard, JCB, American Express</span>
                                </div>
                            </div>
                            <span class="text-slate-400 text-xs">▼</span>
                        </button>
                        
                        <div id="sec-cc" class="hidden p-4 pt-0 border-t border-[#E2E8F0]/5 space-y-2">
                            <div onclick="selectMethod('Kartu Kredit / Debit', 'credit_card')" class="payment-method-card mt-3 p-3.5 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer flex items-center justify-between transition-all">
                                <span class="text-xs font-semibold text-white">Bayar via Kartu Kredit / Debit Online</span>
                                <span class="text-xs font-mono text-slate-400">3D Secure Verified</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Gerai Retail (Indomaret / Alfamart) -->
                    <div class="rounded-2xl border border-[#E2E8F0]/10 bg-[#0B1220]/70 overflow-hidden">
                        <button type="button" onclick="toggleSection('sec-cstore')" class="w-full p-4 text-left flex items-center justify-between hover:bg-slate-800/40 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold text-xs">
                                    OTC
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-white block">Gerai Tunai Retail</span>
                                    <span class="text-[11px] text-slate-400">Indomaret & Alfamart Group</span>
                                </div>
                            </div>
                            <span class="text-slate-400 text-xs">▼</span>
                        </button>
                        
                        <div id="sec-cstore" class="hidden p-4 pt-0 border-t border-[#E2E8F0]/5 space-y-2">
                            <div class="grid grid-cols-2 gap-2.5 pt-3">
                                <div onclick="selectMethod('Indomaret', 'indomaret')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">Indomaret</div>
                                    <div class="text-[10px] text-slate-400">Bayar di kasir</div>
                                </div>
                                <div onclick="selectMethod('Alfamart', 'alfamart')" class="payment-method-card p-3 rounded-xl border border-[#E2E8F0]/15 bg-slate-900/80 hover:border-[#2563EB] cursor-pointer text-left transition-all">
                                    <div class="font-bold text-xs text-white">Alfamart / Alfamidi</div>
                                    <div class="text-[10px] text-slate-400">Bayar di kasir</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Selected Method Action Box -->
                <div class="mt-8 pt-6 border-t border-[#E2E8F0]/10 space-y-4">
                    <div class="p-3.5 rounded-2xl bg-[#0B1220] border border-blue-500/20 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] uppercase font-mono text-slate-400 block">Metode Terpilih</span>
                            <span id="selected-method-label" class="text-sm font-bold text-blue-400 font-mono">Pilih salah satu metode di atas</span>
                        </div>
                        <span id="selected-badge" class="px-2.5 py-1 rounded-md text-[10px] font-mono bg-blue-500/20 text-blue-300 hidden">SIAP BAYAR</span>
                    </div>

                    <!-- Tombol Eksekusi Bayar via Midtrans Snap / Simulator Modal -->
                    <button id="main-pay-btn" onclick="executePayment()" class="w-full py-3.5 px-6 rounded-xl text-center text-sm font-bold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-xl shadow-blue-500/25 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span id="pay-btn-text">Lanjutkan Pembayaran via Midtrans</span>
                    </button>

                    <!-- Tombol Cepat Selesaikan Pembayaran LKPD -->
                    <form action="{{ route('registrations.simulate-pay', $registration) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl text-xs font-semibold text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/25 transition-all flex items-center justify-center gap-2">
                            <span>⚡ Konfirmasi Pelunasan & Terbitkan E-Tiket Digital (Drill LKPD)</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-Up Instruksi Pembayaran (Simulator Virtual Account / QRIS) -->
<div id="payment-modal" class="fixed inset-0 z-50 bg-[#0B1220]/80 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="w-full max-w-md bg-[#0f172a] border border-[#E2E8F0]/20 rounded-3xl p-6 sm:p-8 shadow-2xl relative">
        <button type="button" onclick="closeModal()" class="absolute top-5 right-5 text-slate-400 hover:text-white p-1">✕</button>
        
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-blue-500/20 text-[#2563EB] flex items-center justify-center mx-auto mb-3 font-bold text-lg font-mono">
                MID
            </div>
            <h3 class="text-lg font-bold text-white">Instruksi Pembayaran Midtrans</h3>
            <p id="modal-method-title" class="text-xs text-blue-400 font-mono mt-1">Virtual Account</p>
        </div>

        <div class="space-y-4">
            <div class="p-4 rounded-2xl bg-[#0B1220] border border-[#E2E8F0]/10 text-center">
                <span class="text-[10px] font-mono text-slate-400 uppercase block">Nomor Pembayaran / VA Code</span>
                <span id="modal-va-code" class="text-xl sm:text-2xl font-black text-white font-mono tracking-wider block my-1">
                    88019{{ rand(10000000, 99999999) }}
                </span>
                <span class="text-[10px] text-slate-500 font-mono">Batas Pembayaran: 24 Jam ke depan</span>
            </div>

            <div id="modal-qris-box" class="hidden text-center p-4 bg-white rounded-2xl">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode('MIDTRANS-QRIS-' . $registration->order_id) }}&color=0B1220" 
                     alt="QRIS Midtrans" class="w-36 h-36 mx-auto">
                <span class="text-[10px] font-bold text-slate-800 font-mono mt-2 block">SCAN DENGAN APLIKASI E-WALLET / M-BANKING</span>
            </div>

            <div class="text-xs text-slate-300 space-y-2 border-t border-[#E2E8F0]/10 pt-4">
                <div class="flex justify-between">
                    <span class="text-slate-400">Nominal Transfer:</span>
                    <span class="font-bold text-white font-mono">Rp {{ number_format($registration->amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Status Transaksi:</span>
                    <span class="text-amber-400 font-mono font-semibold">PENDING</span>
                </div>
            </div>

            <form action="{{ route('registrations.simulate-pay', $registration) }}" method="POST" class="pt-2">
                @csrf
                <button type="submit" class="w-full py-3 px-4 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-1.5">
                    <span>✓ Saya Sudah Bayar (Cek Status Otomatis)</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    let currentSelectedMethod = 'QRIS / GoPay';
    let currentSelectedKey = 'qris';

    function toggleSection(id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.toggle('hidden');
        }
    }

    function selectMethod(name, key) {
        currentSelectedMethod = name;
        currentSelectedKey = key;

        document.getElementById('selected-method-label').innerText = name;
        document.getElementById('selected-badge').classList.remove('hidden');

        // Visual highlight card
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.classList.remove('border-[#2563EB]', 'bg-blue-600/10');
            card.classList.add('border-[#E2E8F0]/15');
        });

        if (event && event.currentTarget) {
            event.currentTarget.classList.add('border-[#2563EB]', 'bg-blue-600/10');
            event.currentTarget.classList.remove('border-[#E2E8F0]/15');
        }

        document.getElementById('pay-btn-text').innerText = 'Bayar via ' + name;
    }

    function executePayment() {
        const snapToken = "{{ $registration->snap_token }}";

        // Jika Snap Token Midtrans valid dari API Key asli, buka Snap popup
        if (snapToken && !snapToken.startsWith('SIMULATOR-') && "{{ config('midtrans.server_key') }}" !== 'SB-Mid-server-YOUR_SANDBOX_KEY') {
            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    window.location.href = "{{ route('registrations.simulate-pay', $registration) }}";
                },
                onPending: function (result) {
                    alert('Status transaksi pending. Silakan bayar sesuai petunjuk.');
                },
                onError: function (result) {
                    alert('Pembayaran gagal atau dibatalkan.');
                }
            });
        } else {
            // Tampilkan Modal Instruksi Pembayaran E-Banking / E-Wallet Midtrans Sandbox
            document.getElementById('modal-method-title').innerText = currentSelectedMethod;
            
            const qrisBox = document.getElementById('modal-qris-box');
            if (currentSelectedKey === 'qris' || currentSelectedKey === 'gopay' || currentSelectedKey === 'shopeepay' || currentSelectedKey === 'dana') {
                qrisBox.classList.remove('hidden');
            } else {
                qrisBox.classList.add('hidden');
            }

            const modal = document.getElementById('payment-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeModal() {
        const modal = document.getElementById('payment-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Default select first method on load
    document.addEventListener('DOMContentLoaded', () => {
        selectMethod('QRIS / GoPay', 'qris');
    });
</script>
@endpush
