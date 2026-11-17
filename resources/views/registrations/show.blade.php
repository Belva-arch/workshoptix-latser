@extends('layouts.app')

@section('title', 'Tiket Digital — ' . $registration->ticket_code . ' — WORKSHOPTIX')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">
    <!-- Notice -->
    <div class="text-center mb-8">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-xs font-mono text-emerald-400">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            Pembayaran Terverifikasi • Tiket Aktif
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-3">E-Ticket Digital Workshop</h1>
        <p class="text-xs text-slate-400 mt-1 font-mono">Tunjukkan tiket ini atau sebutkan kode tiket saat registrasi ulang di lokasi.</p>
    </div>

    <!-- Digital Ticket (DICE & Fever Aesthetic: Perforated Edge Stub) -->
    <div class="relative bg-gradient-to-b from-[#131d31] to-[#0f172a] rounded-3xl border border-[#E2E8F0]/20 shadow-2xl overflow-hidden">
        <!-- Top Glow Strip -->
        <div class="h-2.5 w-full bg-gradient-to-r from-blue-500 via-[#2563EB] to-indigo-500"></div>

        <!-- Ticket Body Upper -->
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono uppercase tracking-wider text-blue-400 font-semibold">WORKSHOPTIX PASS</span>
                <span class="text-xs font-mono px-2.5 py-1 rounded-md bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                    LUNAS
                </span>
            </div>

            <div class="mt-4">
                <h2 class="text-xl sm:text-2xl font-extrabold text-white leading-snug">
                    {{ $registration->workshop->title }}
                </h2>
                <p class="text-xs text-slate-400 mt-1 font-mono">Kategori: {{ $registration->workshop->category }}</p>
            </div>

            <!-- Grid Details (Apple / Linear style data points) -->
            <div class="mt-8 grid grid-cols-2 gap-4 border-t border-[#E2E8F0]/10 pt-6">
                <div>
                    <span class="text-[11px] uppercase font-mono text-slate-400 block">Nama Peserta</span>
                    <span class="text-sm font-bold text-white block mt-0.5">{{ $registration->user->name }}</span>
                    <span class="text-xs text-slate-400 block">{{ $registration->user->email }}</span>
                </div>
                <div>
                    <span class="text-[11px] uppercase font-mono text-slate-400 block">Instruktur</span>
                    <span class="text-sm font-bold text-white block mt-0.5">{{ $registration->workshop->instructor }}</span>
                    <span class="text-xs text-slate-400 block">{{ $registration->workshop->instructor_title }}</span>
                </div>
                <div class="mt-2">
                    <span class="text-[11px] uppercase font-mono text-slate-400 block">Jadwal Acara</span>
                    <span class="text-sm font-bold text-white block mt-0.5 font-mono">
                        {{ $registration->workshop->start_time->isoFormat('dddd, D MMM Y') }}
                    </span>
                    <span class="text-xs text-slate-400 font-mono">
                        {{ $registration->workshop->start_time->format('H:i') }} - {{ $registration->workshop->end_time ? $registration->workshop->end_time->format('H:i') : 'Selesai' }} WIB
                    </span>
                </div>
                <div class="mt-2">
                    <span class="text-[11px] uppercase font-mono text-slate-400 block">Lokasi Pelaksanaan</span>
                    <span class="text-sm font-bold text-white block mt-0.5">{{ $registration->workshop->location }}</span>
                    <span class="text-xs text-slate-400">SMK PESAT IT XPRO</span>
                </div>
            </div>
        </div>

        <!-- Perforated Cutout Line (DICE / Fever Style) -->
        <div class="relative flex items-center justify-between px-2 my-2">
            <!-- Left Half Circle Cutout -->
            <div class="w-6 h-6 rounded-full bg-[#0B1220] -ml-5 border-r border-[#E2E8F0]/20"></div>
            <!-- Dashed separator -->
            <div class="flex-grow border-b-2 border-dashed border-[#E2E8F0]/20 mx-2"></div>
            <!-- Right Half Circle Cutout -->
            <div class="w-6 h-6 rounded-full bg-[#0B1220] -mr-5 border-l border-[#E2E8F0]/20"></div>
        </div>

        <!-- Ticket Stub Lower (QR & Booking Code) -->
        <div class="p-6 sm:p-8 bg-[#090e19]/80 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Kode Unik Tiket</span>
                <span class="text-2xl font-black text-white font-mono tracking-widest text-[#2563EB]">
                    {{ $registration->ticket_code }}
                </span>
                <span class="text-[11px] text-slate-500 block font-mono">Terbit pada: {{ $registration->paid_at ? $registration->paid_at->isoFormat('D MMM Y, HH:mm') : '-' }}</span>
            </div>

            <!-- Stylized QR Code Placeholder (DICE ticket aesthetic) -->
            <div class="shrink-0 p-3 bg-white rounded-2xl shadow-md border border-[#E2E8F0] text-center flex flex-col items-center">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode($registration->ticket_code) }}&color=0B1220" 
                     alt="QR Code Tiket" 
                     class="w-24 h-24">
                <span class="text-[9px] font-mono font-bold text-slate-800 mt-1 uppercase tracking-wider">Scan Gate</span>
            </div>
        </div>
    </div>

    <!-- Print / Back Button -->
    <div class="mt-8 flex items-center justify-center gap-4">
        <a href="{{ route('registrations.my-tickets') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 bg-slate-800 hover:bg-slate-700 transition-colors">
            ← Kembali ke Tiket Saya
        </a>
        <button onclick="window.print()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/20">
            Cetak / Simpan PDF
        </button>
    </div>
</div>
@endsection
