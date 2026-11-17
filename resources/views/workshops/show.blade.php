@extends('layouts.app')

@section('title', $workshop->title . ' — WORKSHOPTIX')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6">
        <a href="{{ route('workshops.index') }}" class="hover:text-white transition-colors">Workshop</a>
        <span>/</span>
        <span class="text-blue-400">{{ $workshop->category }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Workshop Content (2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-3xl overflow-hidden border border-[#E2E8F0]/10 bg-[#0f172a]/60 shadow-xl">
                <img src="{{ $workshop->image }}" alt="{{ $workshop->title }}" class="w-full h-80 object-cover">
                
                <div class="p-6 sm:p-8">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="px-2.5 py-1 rounded-md text-xs font-mono bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {{ $workshop->category }}
                        </span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-mono bg-slate-800 text-slate-300 border border-[#E2E8F0]/10">
                            {{ $workshop->location }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-snug">
                        {{ $workshop->title }}
                    </h1>

                    <!-- Instructor Card (Linear Minimal) -->
                    <div class="mt-6 p-4 rounded-2xl bg-[#0B1220]/70 border border-[#E2E8F0]/10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center font-bold text-lg text-white">
                            {{ substr($workshop->instructor, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-xs uppercase font-mono text-slate-400">Instruktur Pemateri</div>
                            <div class="text-sm font-bold text-white">{{ $workshop->instructor }}</div>
                            <div class="text-xs text-slate-400">{{ $workshop->instructor_title ?? 'Praktisi IT Profesional' }}</div>
                        </div>
                    </div>

                    <!-- Workshop Description -->
                    <div class="mt-8 border-t border-[#E2E8F0]/10 pt-6">
                        <h2 class="text-base font-bold text-white mb-3">Tentang Sesi & Silabus</h2>
                        <p class="text-sm leading-relaxed text-slate-300 whitespace-pre-line">
                            {{ $workshop->description }}
                        </p>
                    </div>

                    <!-- Benefits / Include -->
                    <div class="mt-8 border-t border-[#E2E8F0]/10 pt-6">
                        <h3 class="text-base font-bold text-white mb-3">Fasilitas & Benefit Peserta</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-300">
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-800/40 border border-[#E2E8F0]/10">
                                <span class="text-emerald-400 font-bold">✓</span> E-Sertifikat Resmi Terverifikasi
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-800/40 border border-[#E2E8F0]/10">
                                <span class="text-emerald-400 font-bold">✓</span> Full Source Code & Modul Lab
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-800/40 border border-[#E2E8F0]/10">
                                <span class="text-emerald-400 font-bold">✓</span> Akses Tiket Digital QR Code
                            </div>
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-800/40 border border-[#E2E8F0]/10">
                                <span class="text-emerald-400 font-bold">✓</span> Coffee Break & Networking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Registration & Pricing Card (Apple Sticky Card) -->
        <div class="lg:col-span-1">
            <div class="sticky top-24 rounded-3xl border border-[#E2E8F0]/15 bg-[#0f172a] p-6 shadow-2xl shadow-blue-500/5">
                <div class="border-b border-[#E2E8F0]/10 pb-4 mb-4">
                    <span class="text-xs text-slate-400 font-mono uppercase tracking-wider">Tiket Masuk Workshop</span>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-white">Rp {{ number_format($workshop->price, 0, ',', '.') }}</span>
                        <span class="text-xs text-slate-400 font-mono">/ orang</span>
                    </div>
                </div>

                <!-- Schedule Details -->
                <div class="space-y-3 text-xs text-slate-300 py-2">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#2563EB] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <span class="block font-semibold text-white">Jadwal Pelaksanaan</span>
                            <span class="font-mono">{{ $workshop->start_time->isoFormat('dddd, D MMMM Y') }}</span>
                            <span class="font-mono block text-slate-400">{{ $workshop->start_time->format('H:i') }} - {{ $workshop->end_time ? $workshop->end_time->format('H:i') : 'Selesai' }} WIB</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#2563EB] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <span class="block font-semibold text-white">Lokasi Sesi</span>
                            <span class="text-slate-400">{{ $workshop->location }}</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#2563EB] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div>
                            <span class="block font-semibold text-white">Status Kuota</span>
                            <span class="font-mono text-emerald-400 font-medium">Tersisa {{ $workshop->remaining_quota }} dari {{ $workshop->quota }} kursi</span>
                        </div>
                    </div>
                </div>

                <!-- Registration Action Box -->
                <div class="mt-6 pt-5 border-t border-[#E2E8F0]/10">
                    @guest
                        <a href="{{ route('login') }}" class="block w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-lg shadow-blue-500/20">
                            Masuk untuk Mendaftar
                        </a>
                        <p class="mt-2 text-center text-[11px] text-slate-400 font-mono">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Daftar sekarang</a></p>
                    @else
                        @if(auth()->user()->isPanitia())
                            <div class="p-3 bg-slate-800 rounded-xl text-xs text-center text-slate-300 font-mono">
                                Anda login sebagai Panitia
                            </div>
                        @elseif($userRegistered)
                            @if($userRegistration->payment_status === 'paid')
                                <a href="{{ route('registrations.show', $userRegistration) }}" class="block w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-500/20">
                                    Lihat Tiket Digital Saya
                                </a>
                                <p class="mt-2 text-center text-[11px] text-emerald-400 font-mono">✓ Pendaftaran & Pembayaran Lunas</p>
                            @else
                                <a href="{{ route('registrations.pay', $userRegistration) }}" class="block w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20">
                                    Selesaikan Pembayaran
                                </a>
                                <p class="mt-2 text-center text-[11px] text-amber-400 font-mono">Menunggu Konfirmasi Pembayaran</p>
                            @endif
                        @elseif($workshop->remaining_quota <= 0)
                            <button disabled class="w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-slate-500 bg-slate-800 cursor-not-allowed">
                                Kuota Workshop Penuh
                            </button>
                        @else
                            <form action="{{ route('registrations.store', $workshop) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-lg shadow-blue-500/25">
                                    Daftar Sesi Workshop Sekarang
                                </button>
                            </form>
                            <p class="mt-2.5 text-center text-[11px] text-slate-400">
                                Pembayaran digital aman via Midtrans Sandbox
                            </p>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
