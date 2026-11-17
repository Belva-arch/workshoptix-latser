@extends('layouts.app')

@section('title', 'Dashboard Panitia — WORKSHOPTIX')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-8 border-b border-[#E2E8F0]/10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-xs font-mono text-blue-400 mb-2">
                Panel Panitia Workshop IT
            </div>
            <h1 class="text-3xl font-extrabold text-white">Dashboard Monitoring</h1>
            <p class="text-xs text-slate-400 mt-1 font-mono">Kelola workshop, validasi tiket peserta, dan pantau metrik query database.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('dashboard.participants') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-slate-800 hover:bg-slate-700 border border-[#E2E8F0]/15 transition-all flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Audit Query N+1</span>
            </a>
            <a href="{{ route('dashboard.workshops.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-md shadow-blue-500/20 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Workshop Baru</span>
            </a>
        </div>
    </div>

    <!-- Stat Cards (Apple / Notion Minimal Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
        <div class="p-6 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Workshop</span>
            <div class="text-3xl font-extrabold text-white mt-2">{{ $stats['total_workshops'] }}</div>
            <span class="text-[11px] text-blue-400 mt-1 block">Aktif dalam katalog</span>
        </div>

        <div class="p-6 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Peserta Terdaftar (Lunas)</span>
            <div class="text-3xl font-extrabold text-emerald-400 mt-2 font-mono">{{ $stats['total_participants'] }}</div>
            <span class="text-[11px] text-slate-400 mt-1 block">Tiket digital aktif</span>
        </div>

        <div class="p-6 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Penerimaan Dana</span>
            <div class="text-2xl font-extrabold text-white mt-2 font-mono">
                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </div>
            <span class="text-[11px] text-emerald-400 mt-1 block">Telah diverifikasi Midtrans</span>
        </div>

        <div class="p-6 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Tagihan Pending</span>
            <div class="text-3xl font-extrabold text-amber-400 mt-2 font-mono">{{ $stats['pending_payments'] }}</div>
            <span class="text-[11px] text-slate-400 mt-1 block">Menunggu penyelesaian</span>
        </div>
    </div>

    <!-- 2 Column Section: Workshop Table & Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
        <!-- Workshop Management (2 Cols) -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-white">Daftar Workshop IT</h2>
                <a href="{{ route('dashboard.workshops') }}" class="text-xs text-blue-400 hover:underline">Kelola Semua →</a>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-[#E2E8F0]/10 bg-[#0f172a]">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="bg-[#0B1220]/70 text-[11px] uppercase font-mono text-slate-400 border-b border-[#E2E8F0]/10">
                        <tr>
                            <th class="p-4">Workshop</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Kuota / Terisi</th>
                            <th class="p-4">Investasi</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0]/5">
                        @foreach($workshops as $ws)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="p-4">
                                    <div class="font-bold text-white">{{ $ws->title }}</div>
                                    <div class="text-slate-400 text-[11px]">{{ $ws->instructor }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        {{ $ws->category }}
                                    </span>
                                </td>
                                <td class="p-4 font-mono">
                                    <span class="text-emerald-400 font-semibold">{{ $ws->paid_count }}</span> / {{ $ws->quota }}
                                </td>
                                <td class="p-4 font-mono font-semibold text-white">
                                    Rp {{ number_format($ws->price, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('dashboard.workshops.edit', $ws) }}" class="text-blue-400 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Registrations (1 Col) -->
        <div class="space-y-4">
            <h2 class="text-lg font-bold text-white">Transaksi Terbaru</h2>
            <div class="p-5 rounded-2xl border border-[#E2E8F0]/10 bg-[#0f172a] space-y-4">
                @forelse($recentRegistrations as $reg)
                    <div class="pb-3.5 border-b border-[#E2E8F0]/5 last:border-b-0 last:pb-0">
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="font-bold text-white">{{ $reg->user->name }}</span>
                            @if($reg->payment_status === 'paid')
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-500/15 text-emerald-300">PAID</span>
                            @else
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-500/15 text-amber-300">PENDING</span>
                            @endif
                        </div>
                        <p class="text-[11px] text-slate-400 truncate">{{ $reg->workshop->title }}</p>
                        <div class="mt-1 flex items-center justify-between text-[11px] text-slate-500 font-mono">
                            <span>{{ $reg->order_id }}</span>
                            <span class="text-slate-300 font-semibold">Rp {{ number_format($reg->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-4">Belum ada transaksi.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
