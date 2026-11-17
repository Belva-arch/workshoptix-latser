@extends('layouts.app')

@section('title', 'Katalog Workshop IT — WORKSHOPTIX')

@section('content')
<div class="relative overflow-hidden bg-grid-pattern">
    <!-- Subtle glow gradient on top -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-gradient-to-b from-[#2563EB]/15 via-[#2563EB]/5 to-transparent blur-3xl pointer-events-none"></div>

    <!-- Top Announcement Bar (Promosi Early Bird) -->
    <div class="relative bg-gradient-to-r from-blue-700 via-indigo-600 to-blue-700 text-white text-xs py-2.5 px-4 font-mono text-center flex items-center justify-center gap-2 border-b border-blue-400/20 shadow-md">
        <span class="px-2 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold tracking-wider uppercase animate-pulse">PROMO SPESIAL</span>
        <span class="font-sans font-medium text-slate-100">🔥 Early Bird Promo: Dapatkan <strong>E-Sertifikat Resmi & Modul Praktik Eksklusif</strong> di setiap workshop!</span>
        <a href="#katalog-workshop" class="underline font-bold text-white hover:text-blue-200 hidden sm:inline ml-1">Klaim Kursi Sekarang →</a>
    </div>

    <!-- Hero Section (Apple / Linear / Awwwards Aesthetic) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-10 sm:pt-20 sm:pb-14 relative z-10">
        <div class="text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#E2E8F0]/10 border border-[#E2E8F0]/20 text-xs font-mono text-slate-300 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                Official IT Workshop & Digital Ticketing Platform
            </div>
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white max-w-4xl mx-auto leading-[1.15]">
                Tingkatkan Skill IT, <br class="hidden sm:inline">
                <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">Dapatkan Tiket Workshopmu</span> Hari Ini.
            </h1>
            <p class="mt-5 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto font-normal leading-relaxed">
                Platform pendaftaran resmi workshop IT sekolah berbayar. Belajar langsung dari praktisi industri, kuasai Laravel, Cyber Security, Cloud, dan AI dengan tiket digital instan terintegrasi Midtrans.
            </p>

            <!-- CTA Actions -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="#katalog-workshop" class="px-6 py-3.5 rounded-xl font-semibold text-sm text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-xl shadow-blue-500/25 flex items-center gap-2 group">
                    <span>Jelajahi Workshop Pilihan</span>
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <a href="#keunggulan" class="px-6 py-3.5 rounded-xl font-semibold text-sm text-slate-300 hover:text-white bg-slate-900/80 hover:bg-slate-800 border border-[#E2E8F0]/15 transition-all">
                    Kenapa Harus Ikut?
                </a>
            </div>
        </div>

        <!-- Interactive Promo Carousel Banner (Loket.com / DICE Hero Carousel) -->
        <div class="mt-12 relative group" id="promo-carousel-container">
            <!-- Carousel Slide Track -->
            <div class="overflow-hidden rounded-3xl border border-[#E2E8F0]/20 bg-gradient-to-br from-[#131d31] via-[#0f172a] to-[#080D17] shadow-2xl relative">
                <!-- Decorative Glow Behind Slide -->
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#2563EB]/20 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Slides Wrapper (1 Foto Penuh Landscape per Slide ala Loket.com) -->
                <div id="carousel-track" class="flex transition-transform duration-700 ease-in-out">
                    
                    <!-- Slide 1: Laravel Full-Stack Banner -->
                    <div class="min-w-full relative h-[340px] sm:h-[420px] shrink-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1600&auto=format&fit=crop" 
                             class="w-full h-full object-cover" 
                             alt="Laravel Full-Stack Workshop">
                        <!-- Dark gradient overlay to guarantee perfect contrast -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1220] via-[#0B1220]/75 to-[#0B1220]/20 sm:bg-gradient-to-r sm:from-[#0B1220] sm:via-[#0B1220]/80 sm:to-transparent"></div>
                        
                        <!-- Overlay Content -->
                        <div class="absolute inset-0 p-6 sm:p-12 flex flex-col justify-end sm:justify-center max-w-2xl text-left">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[10px] font-mono font-bold animate-pulse">
                                    🔥 TRENDING #1
                                </span>
                                <span class="text-xs font-mono text-blue-400">Web Development</span>
                            </div>
                            <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                                Mastering Modern Full-Stack Laravel 11 & React Inertia
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-300 mt-2 line-clamp-2">
                                Bersama Alex Pratama (Senior GoTo). Bedah tuntas arsitektur enterprise, SSR, dan database indexing skala jutaan user!
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <span class="text-lg sm:text-xl font-extrabold text-white font-mono">Rp 75.000</span>
                                <a href="{{ route('workshops.show', 'mastering-modern-full-stack-laravel-11-react-inertia') }}" 
                                   class="px-5 py-2.5 rounded-xl bg-[#2563EB] hover:bg-blue-600 text-white font-bold text-xs shadow-lg shadow-blue-500/30 transition-all flex items-center gap-1.5">
                                    <span>Beli Tiket Sekarang</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Cyber Security Banner -->
                    <div class="min-w-full relative h-[340px] sm:h-[420px] shrink-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop" 
                             class="w-full h-full object-cover" 
                             alt="Cyber Security Workshop">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1220] via-[#0B1220]/75 to-[#0B1220]/20 sm:bg-gradient-to-r sm:from-[#0B1220] sm:via-[#0B1220]/80 sm:to-transparent"></div>
                        
                        <div class="absolute inset-0 p-6 sm:p-12 flex flex-col justify-end sm:justify-center max-w-2xl text-left">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[10px] font-mono font-bold">
                                    ⚡ PALING DIMINATI
                                </span>
                                <span class="text-xs font-mono text-blue-400">Cyber Security</span>
                            </div>
                            <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                                Penetration Testing & API Vulnerability Defense
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-300 mt-2 line-clamp-2">
                                Praktik langsung eksploitasi API endpoints, OWASP Top 10, dan audit keamanan server bersama Certified Ethical Hacker.
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <span class="text-lg sm:text-xl font-extrabold text-white font-mono">Rp 95.000</span>
                                <a href="{{ route('workshops.show', 'cyber-security-defense-penetration-testing-api-vulnerability') }}" 
                                   class="px-5 py-2.5 rounded-xl bg-[#2563EB] hover:bg-blue-600 text-white font-bold text-xs shadow-lg shadow-blue-500/30 transition-all flex items-center gap-1.5">
                                    <span>Beli Tiket Sekarang</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Generative AI Banner -->
                    <div class="min-w-full relative h-[340px] sm:h-[420px] shrink-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1600&auto=format&fit=crop" 
                             class="w-full h-full object-cover" 
                             alt="AI Workshop">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1220] via-[#0B1220]/75 to-[#0B1220]/20 sm:bg-gradient-to-r sm:from-[#0B1220] sm:via-[#0B1220]/80 sm:to-transparent"></div>
                        
                        <div class="absolute inset-0 p-6 sm:p-12 flex flex-col justify-end sm:justify-center max-w-2xl text-left">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-[10px] font-mono font-bold">
                                    ✨ TOP INNOVATION
                                </span>
                                <span class="text-xs font-mono text-blue-400">Artificial Intelligence</span>
                            </div>
                            <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                                Generative AI & LLM Integration for Web Apps
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-300 mt-2 line-clamp-2">
                                Implementasi OpenAI API, Function Calling, dan RAG Vector Database ke dalam aplikasi web nyata bersama Dr. Hendra Gunawan.
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <span class="text-lg sm:text-xl font-extrabold text-white font-mono">Rp 120.000</span>
                                <a href="{{ route('workshops.show', 'generative-ai-llm-integration-for-web-applications') }}" 
                                   class="px-5 py-2.5 rounded-xl bg-[#2563EB] hover:bg-blue-600 text-white font-bold text-xs shadow-lg shadow-blue-500/30 transition-all flex items-center gap-1.5">
                                    <span>Beli Tiket Sekarang</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Navigation Arrows (Prev / Next buttons on hover) -->
                <button type="button" onclick="moveCarousel(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-[#0B1220]/80 border border-[#E2E8F0]/20 text-white flex items-center justify-center hover:bg-[#2563EB] transition-all opacity-80 sm:opacity-0 group-hover:opacity-100 shadow-xl z-20" aria-label="Slide sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" onclick="moveCarousel(1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-[#0B1220]/80 border border-[#E2E8F0]/20 text-white flex items-center justify-center hover:bg-[#2563EB] transition-all opacity-80 sm:opacity-0 group-hover:opacity-100 shadow-xl z-20" aria-label="Slide berikutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Dots Indicator / Loket.com Style -->
            <div class="mt-4 flex items-center justify-center gap-2">
                <button type="button" onclick="goToSlide(0)" class="carousel-dot h-2 w-8 rounded-full bg-[#2563EB] transition-all duration-300" aria-label="Ke slide 1"></button>
                <button type="button" onclick="goToSlide(1)" class="carousel-dot h-2 w-2 rounded-full bg-slate-700 hover:bg-slate-500 transition-all duration-300" aria-label="Ke slide 2"></button>
                <button type="button" onclick="goToSlide(2)" class="carousel-dot h-2 w-2 rounded-full bg-slate-700 hover:bg-slate-500 transition-all duration-300" aria-label="Ke slide 3"></button>
            </div>
        </div>

        <!-- Value Proposition / "Kenapa Ikut Workshop IT Ini?" (Notion/Linear Clean Feature Grid) -->
        <div id="keunggulan" class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <div class="p-6 rounded-2xl bg-[#0f172a]/80 border border-[#E2E8F0]/10 hover:border-[#2563EB]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 text-[#2563EB] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-white">Materi Berstandar Industri</h3>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Bukan sekadar teori. Kamu akan praktik langsung membuat arsitektur aplikasi riil, keamanan sistem siber, container Docker, hingga implementasi Generative AI.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-[#0f172a]/80 border border-[#E2E8F0]/10 hover:border-[#2563EB]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-white">E-Tiket & Verifikasi Otomatis</h3>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Setelah checkout terverifikasi oleh Midtrans, sistem langsung menerbitkan tiket digital resmi ber-QR Code dengan proteksi anti-tiket ganda.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-[#0f172a]/80 border border-[#E2E8F0]/10 hover:border-[#2563EB]/40 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-white">Drill Pra-Sertifikasi RPL</h3>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Dirancang khusus untuk mengasah kompetensi siswa XI RPL agar 100% siap menghadapi uji sertifikasi keahlian perangkat lunak.
                </p>
            </div>
        </div>

        <!-- Search & Category Filters (Notion / Linear Style) -->
        <div id="katalog-workshop" class="mt-20 max-w-3xl mx-auto scroll-mt-24">
            <div class="text-center mb-6">
                <span class="text-xs font-mono uppercase tracking-widest text-[#2563EB] font-bold">Katalog Resmi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">Pilih Sesi Workshop IT Kamu</h2>
            </div>
            <form action="{{ route('workshops.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari workshop, teknologi, atau instruktur..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-[#0f172a]/90 border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:border-transparent transition-all">
                </div>
                <div class="flex gap-2">
                    <select name="category" onchange="this.form.submit()" 
                        class="px-4 py-2.5 bg-[#0f172a]/90 border border-[#E2E8F0]/15 rounded-xl text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-5 py-2.5 bg-[#2563EB] hover:bg-blue-600 text-white font-medium text-sm rounded-xl transition-all shadow-md shadow-blue-500/20">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Workshop Cards Grid (DICE & Linear Card Style) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        @if($workshops->isEmpty())
            <div class="text-center py-20 bg-slate-900/40 rounded-3xl border border-[#E2E8F0]/10">
                <p class="text-slate-400 text-base">Tidak ada workshop IT yang sesuai dengan kriteria pencarian.</p>
                <a href="{{ route('workshops.index') }}" class="mt-4 inline-block text-xs font-semibold text-[#2563EB] hover:underline">
                    Reset Filter
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($workshops as $ws)
                    <div class="group flex flex-col bg-[#0f172a]/70 rounded-2xl border border-[#E2E8F0]/10 hover:border-[#2563EB]/50 transition-all duration-300 overflow-hidden hover:shadow-xl hover:shadow-blue-500/10">
                        <!-- Image & Badges -->
                        <div class="relative h-48 w-full overflow-hidden bg-slate-800">
                            <img src="{{ $ws->image }}" alt="{{ $ws->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-transparent to-transparent"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-md text-[11px] font-mono font-medium tracking-wide bg-[#0B1220]/80 backdrop-blur-md text-slate-200 border border-[#E2E8F0]/15">
                                    {{ $ws->category }}
                                </span>
                            </div>

                            <!-- Quota Badge -->
                            <div class="absolute top-3 right-3">
                                @if($ws->remaining_quota > 0)
                                    <span class="px-2 py-0.5 rounded text-[11px] font-mono font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        Sisa {{ $ws->remaining_quota }} Slot
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[11px] font-mono font-semibold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                        Penuh
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <!-- Date & Location -->
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-2 font-mono">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $ws->start_time->isoFormat('D MMM Y • HH:mm') }} WIB
                                    </span>
                                </div>

                                <h2 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors line-clamp-2 leading-snug">
                                    {{ $ws->title }}
                                </h2>

                                <p class="mt-2 text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                    {{ $ws->description }}
                                </p>
                            </div>

                            <!-- Instructor Info & Price / Action -->
                            <div class="mt-6 pt-4 border-t border-[#E2E8F0]/10 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-mono">Investasi</span>
                                    <span class="text-base font-bold text-white">
                                        Rp {{ number_format($ws->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <a href="{{ route('workshops.show', $ws->slug) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-colors shadow-sm shadow-blue-500/20">
                                    <span>Detail Sesi</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $workshops->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    let currentSlide = 0;
    const totalSlides = 3;
    let autoSlideInterval;

    function updateCarousel() {
        const track = document.getElementById('carousel-track');
        if (!track) return;
        track.style.transform = `translateX(-${currentSlide * 100}%)`;

        // Update Dots Indicator
        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, idx) => {
            if (idx === currentSlide) {
                dot.classList.add('w-8', 'bg-[#2563EB]');
                dot.classList.remove('w-2', 'bg-slate-700');
            } else {
                dot.classList.remove('w-8', 'bg-[#2563EB]');
                dot.classList.add('w-2', 'bg-slate-700');
            }
        });
    }

    function moveCarousel(direction) {
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        updateCarousel();
        resetTimer();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
        resetTimer();
    }

    function startTimer() {
        autoSlideInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }, 4500); // Geser otomatis setiap 4.5 detik ala Loket.com
    }

    function resetTimer() {
        clearInterval(autoSlideInterval);
        startTimer();
    }

    // Jalankan timer saat load
    document.addEventListener('DOMContentLoaded', () => {
        startTimer();
    });

    // Pause saat kursor berada di atas banner
    const container = document.getElementById('promo-carousel-container');
    if (container) {
        container.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        container.addEventListener('mouseleave', () => startTimer());
    }
</script>
@endpush
@endsection
