<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_workshops' => Workshop::count(),
            'total_participants' => Registration::where('payment_status', 'paid')->count(),
            'total_revenue' => Registration::where('payment_status', 'paid')->sum('amount'),
            'pending_payments' => Registration::where('payment_status', 'pending')->count(),
        ];

        $recentRegistrations = Registration::with(['user', 'workshop'])
            ->latest()
            ->take(6)
            ->get();

        $workshops = Workshop::withCount(['registrations as paid_count' => function ($q) {
            $q->where('payment_status', 'paid');
        }])->get();

        return view('dashboard.index', compact('stats', 'recentRegistrations', 'workshops'));
    }

    public function workshops()
    {
        $workshops = Workshop::withCount(['registrations as paid_count' => function ($q) {
            $q->where('payment_status', 'paid');
        }])->latest()->paginate(10);

        return view('dashboard.workshops.index', compact('workshops'));
    }

    public function createWorkshop()
    {
        return view('dashboard.workshops.create');
    }

    public function storeWorkshop(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'instructor' => 'required|string|max:255',
            'instructor_title' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        if (empty($validated['image'])) {
            $validated['image'] = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=1200&auto=format&fit=crop';
        }

        Workshop::create($validated);

        return redirect()->route('dashboard.workshops')->with('success', 'Workshop berhasil ditambahkan!');
    }

    public function editWorkshop(Workshop $workshop)
    {
        return view('dashboard.workshops.edit', compact('workshop'));
    }

    public function updateWorkshop(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'instructor' => 'required|string|max:255',
            'instructor_title' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ]);

        $workshop->update($validated);

        return redirect()->route('dashboard.workshops')->with('success', 'Data workshop berhasil diperbarui!');
    }

    public function destroyWorkshop(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('dashboard.workshops')->with('success', 'Workshop berhasil dihapus.');
    }

    public function participants(Request $request)
    {
        $eagerMode = $request->query('eager', '1') === '1';

        // Tracking queries untuk perbandingan N+1 sesuai LKPD Checkpoint 05
        DB::flushQueryLog();
        DB::enableQueryLog();

        $startTime = microtime(true);

        if ($eagerMode) {
            // Eager Loading (Optimized: 2 - 3 query)
            $registrations = Registration::with(['user', 'workshop'])->latest()->paginate(15);
        } else {
            // Lazy Loading (Menyebabkan N+1 problem: 1 query registrations + 1 user query per row + 1 workshop query per row)
            $registrations = Registration::latest()->paginate(15);
        }

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $queries = DB::getQueryLog();
        $queryCount = count($queries);

        return view('dashboard.participants', compact('registrations', 'eagerMode', 'queryCount', 'executionTime', 'queries'));
    }
}
