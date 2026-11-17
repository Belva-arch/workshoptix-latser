@extends('layouts.app')

@section('title', 'Audit & Uji Perbandingan N+1 Query — LKPD Checkpoint 05')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6">
        <a href="{{ route('dashboard.index') }}" class="hover:text-white transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-blue-400">Checkpoint 05 — Audit Query N+1</span>
    </div>

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 pb-6 border-b border-[#E2E8F0]/10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-xs font-mono text-emerald-400 mb-2">
                LKPD Checkpoint 05 • Periksa N+1 & Gabungkan
            </div>
            <h1 class="text-3xl font-extrabold text-white">Perbandingan Query: Eager vs Lazy Loading</h1>
            <p class="text-xs text-slate-400 mt-1 font-mono">
                Buktikan jumlah query sebelum dan sesudah eager loading (<code>with(['user', 'workshop'])</code>) untuk laporan drill pra-sertifikasi.
            </p>
        </div>

        <!-- Mode Toggle Switch (Linear Style) -->
        <div class="inline-flex p-1.5 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/15">
            <a href="{{ route('dashboard.participants', ['eager' => 1]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-semibold font-mono transition-all {{ $eagerMode ? 'bg-[#2563EB] text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                ✓ Eager Loading (Optimized)
            </a>
            <a href="{{ route('dashboard.participants', ['eager' => 0]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-semibold font-mono transition-all {{ !$eagerMode ? 'bg-rose-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                ⚠ Lazy Loading (N+1 Problem)
            </a>
        </div>
    </div>

    <!-- Benchmark Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mt-6">
        <div class="p-5 rounded-2xl bg-[#0f172a] border {{ $eagerMode ? 'border-emerald-500/30' : 'border-rose-500/30' }}">
            <span class="text-xs font-mono uppercase text-slate-400">Total Database Queries</span>
            <div class="text-3xl font-extrabold font-mono mt-2 {{ $eagerMode ? 'text-emerald-400' : 'text-rose-400' }}">
                {{ $queryCount }} Query
            </div>
            <span class="text-[11px] text-slate-400 mt-1 block font-mono">
                {{ $eagerMode ? 'Sangat efisien (2-3 query)' : 'Membengkak seiring jumlah baris pendaftar' }}
            </span>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase text-slate-400">Waktu Eksekusi Query</span>
            <div class="text-3xl font-extrabold font-mono text-white mt-2">
                {{ $executionTime }} ms
            </div>
            <span class="text-[11px] text-slate-400 mt-1 block font-mono">Microtime database duration</span>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10">
            <span class="text-xs font-mono uppercase text-slate-400">Status Optimasi LKPD</span>
            <div class="text-xl font-bold mt-2 {{ $eagerMode ? 'text-emerald-400' : 'text-amber-400' }}">
                {{ $eagerMode ? 'Optimal (Eager Loaded)' : 'Terdeteksi N+1 Queries' }}
            </div>
            <span class="text-[11px] text-slate-400 mt-1 block font-mono">
                {{ $eagerMode ? 'Ready for production drill' : 'Gunakan with() untuk fix' }}
            </span>
        </div>
    </div>

    <!-- Data Table Pendaftar -->
    <div class="mt-8 rounded-2xl border border-[#E2E8F0]/10 bg-[#0f172a] overflow-hidden">
        <div class="p-4 border-b border-[#E2E8F0]/10 flex items-center justify-between">
            <h2 class="text-sm font-bold text-white">Daftar Pendaftar (Menampilkan Nama Peserta & Workshop)</h2>
            <span class="text-xs font-mono text-slate-400">Menampilkan {{ $registrations->count() }} data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-[#0B1220]/70 text-[11px] uppercase font-mono text-slate-400 border-b border-[#E2E8F0]/10">
                    <tr>
                        <th class="p-3.5">Order ID</th>
                        <th class="p-3.5">Nama Peserta ($registration->user->name)</th>
                        <th class="p-3.5">Workshop ($registration->workshop->title)</th>
                        <th class="p-3.5">Status Bayar</th>
                        <th class="p-3.5">Kode Tiket</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]/5 font-mono">
                    @forelse($registrations as $r)
                        <tr class="hover:bg-slate-800/40">
                            <td class="p-3.5 text-blue-400">{{ $r->order_id }}</td>
                            <td class="p-3.5 font-sans font-semibold text-white">
                                {{ $r->user->name }}
                                <span class="block text-[11px] text-slate-400 font-mono font-normal">{{ $r->user->email }}</span>
                            </td>
                            <td class="p-3.5 font-sans text-slate-200">
                                {{ $r->workshop->title }}
                            </td>
                            <td class="p-3.5">
                                @if($r->payment_status === 'paid')
                                    <span class="px-2 py-0.5 rounded text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">PAID</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30">PENDING</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-slate-400">
                                {{ $r->ticket_code ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-500 font-sans">
                                Belum ada pendaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Query Log Inspector Box (Linear Terminal Aesthetic) -->
    <div class="mt-8 p-5 rounded-2xl bg-[#080D17] border border-[#E2E8F0]/15">
        <div class="flex items-center justify-between pb-3 border-b border-[#E2E8F0]/10 mb-4">
            <span class="text-xs font-mono font-bold text-slate-300 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                Bukti Query Database yang Dieksekusi (Query Log):
            </span>
            <span class="text-xs font-mono text-slate-500">{{ count($queries) }} Queries</span>
        </div>

        <div class="space-y-2 max-h-80 overflow-y-auto font-mono text-[11px]">
            @foreach($queries as $index => $q)
                <div class="p-2.5 rounded-lg bg-[#0B1220] border border-[#E2E8F0]/5 flex items-start gap-3">
                    <span class="text-slate-500 font-bold">#{{ $index + 1 }}</span>
                    <div class="flex-grow">
                        <div class="text-blue-300 break-all">{{ $q['query'] }}</div>
                        <div class="text-[10px] text-slate-500 mt-1">Time: {{ $q['time'] }}ms</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
