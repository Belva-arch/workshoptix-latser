@extends('layouts.app')

@section('title', 'Tiket Saya — WORKSHOPTIX')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Tiket Workshop Saya</h1>
            <p class="text-xs text-slate-400 mt-1 font-mono">Daftar pendaftaran dan tiket digital milik akun {{ auth()->user()->name }}</p>
        </div>
        <a href="{{ route('workshops.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-colors shadow-sm">
            + Cari Workshop Lain
        </a>
    </div>

    @if($registrations->isEmpty())
        <div class="text-center py-20 bg-[#0f172a]/60 rounded-3xl border border-[#E2E8F0]/10">
            <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-800 flex items-center justify-center text-slate-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
            </div>
            <h3 class="text-base font-bold text-white">Belum Ada Tiket</h3>
            <p class="text-xs text-slate-400 mt-1">Kamu belum pernah mendaftar ke workshop IT apapun.</p>
            <a href="{{ route('workshops.index') }}" class="mt-4 inline-block text-xs font-semibold text-[#2563EB] hover:underline">
                Jelajahi Workshop Sekarang →
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($registrations as $reg)
                <div class="p-5 sm:p-6 rounded-2xl bg-[#0f172a] border border-[#E2E8F0]/10 hover:border-[#2563EB]/40 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono px-2 py-0.5 rounded bg-slate-800 text-slate-300 border border-[#E2E8F0]/10">
                                {{ $reg->workshop->category }}
                            </span>
                            @if($reg->payment_status === 'paid')
                                <span class="text-xs font-mono px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                    LUNAS
                                </span>
                            @else
                                <span class="text-xs font-mono px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                    PENDING
                                </span>
                            @endif
                            <span class="text-xs font-mono text-slate-500">Order: {{ $reg->order_id }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">{{ $reg->workshop->title }}</h3>
                        <p class="text-xs text-slate-400 font-mono">
                            {{ $reg->workshop->start_time->isoFormat('dddd, D MMM Y • HH:mm') }} WIB • {{ $reg->workshop->location }}
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center gap-3">
                        @if($reg->payment_status === 'paid')
                            <a href="{{ route('registrations.show', $reg) }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-500 transition-colors shadow-sm">
                                Buka E-Tiket Digital
                            </a>
                        @else
                            <a href="{{ route('registrations.pay', $reg) }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-colors shadow-sm">
                                Bayar Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
