<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('q');

        $query = Workshop::query()->withCount(['registrations as paid_registrations_count' => function ($q) {
            $q->where('payment_status', 'paid');
        }]);

        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('instructor', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $workshops = $query->orderBy('start_time', 'asc')->paginate(9)->withQueryString();
        $categories = Workshop::select('category')->distinct()->pluck('category');

        return view('workshops.index', compact('workshops', 'categories', 'category', 'search'));
    }

    public function show(Workshop $workshop)
    {
        $workshop->loadCount(['registrations as paid_count' => function ($q) {
            $q->where('payment_status', 'paid');
        }]);

        $userRegistered = false;
        $userRegistration = null;

        if (auth()->check()) {
            $userRegistration = $workshop->registrations()
                ->where('user_id', auth()->id())
                ->first();
            $userRegistered = (bool) $userRegistration;
        }

        return view('workshops.show', compact('workshop', 'userRegistered', 'userRegistration'));
    }
}
