@extends('layouts.app')

@section('title', 'Kelola Workshop IT — Panel Panitia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-2">
                <a href="{{ route('dashboard.index') }}" class="hover:text-white">Dashboard</a>
                <span>/</span>
                <span class="text-blue-400">Workshop</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Kelola Workshop IT</h1>
        </div>
        <a href="{{ route('dashboard.workshops.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-md">
            + Tambah Workshop
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-[#E2E8F0]/10 bg-[#0f172a]">
        <table class="w-full text-left text-xs text-slate-300">
            <thead class="bg-[#0B1220]/70 text-[11px] uppercase font-mono text-slate-400 border-b border-[#E2E8F0]/10">
                <tr>
                    <th class="p-4">Workshop</th>
                    <th class="p-4">Instruktur</th>
                    <th class="p-4">Jadwal</th>
                    <th class="p-4">Biaya</th>
                    <th class="p-4">Kuota / Terisi</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E2E8F0]/5">
                @foreach($workshops as $ws)
                    <tr class="hover:bg-slate-800/40">
                        <td class="p-4">
                            <div class="font-bold text-white">{{ $ws->title }}</div>
                            <span class="text-[11px] font-mono text-blue-400">{{ $ws->category }}</span>
                        </td>
                        <td class="p-4 text-slate-300">{{ $ws->instructor }}</td>
                        <td class="p-4 font-mono text-slate-400">{{ $ws->start_time->isoFormat('D MMM Y • HH:mm') }}</td>
                        <td class="p-4 font-mono font-semibold text-white">Rp {{ number_format($ws->price, 0, ',', '.') }}</td>
                        <td class="p-4 font-mono"><span class="text-emerald-400 font-bold">{{ $ws->paid_count }}</span> / {{ $ws->quota }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('dashboard.workshops.edit', $ws) }}" class="text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('dashboard.workshops.destroy', $ws) }}" method="POST" class="inline" onsubmit="return confirm('Hapus workshop ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $workshops->links() }}
    </div>
</div>
@endsection
