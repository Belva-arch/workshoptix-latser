<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WORKSHOPTIX — Platform Workshop IT & Digital Ticketing')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            --color-primary-navy: #0B1220;
            --color-electric-blue: #2563EB;
            --color-electric-blue-hover: #1D4ED8;
            --color-cool-silver: #E2E8F0;
        }
    </style>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0B1220;
            color: #F8FAFC;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(226, 232, 240, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .ticket-cutout-l {
            position: relative;
        }
        .ticket-cutout-l::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -14px;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            background-color: #0B1220;
            border-radius: 50%;
            border-right: 1px solid rgba(226, 232, 240, 0.15);
        }
        .ticket-cutout-r {
            position: relative;
        }
        .ticket-cutout-r::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -14px;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            background-color: #0B1220;
            border-radius: 50%;
            border-left: 1px solid rgba(226, 232, 240, 0.15);
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-[#0B1220] text-slate-100 antialiased selection:bg-[#2563EB] selection:text-white">
    <!-- Navbar (Linear/Apple Minimalist Style) -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-[#0B1220]/80 border-b border-[#E2E8F0]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand Logo -->
                <!-- Brand Logo (Official Uploaded Logo) -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('workshops.index') }}" class="flex items-center group py-1">
                        <img src="{{ asset('images/logo.png') }}" alt="workshoptix logo" class="h-6 sm:h-7 w-auto object-contain group-hover:opacity-90 transition-opacity">
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="{{ route('workshops.index') }}" class="text-slate-300 hover:text-white transition-colors duration-150">
                        Katalog Workshop
                    </a>
                    @auth
                        @if(!auth()->user()->isPanitia())
                            <a href="{{ route('registrations.my-tickets') }}" class="text-slate-300 hover:text-white transition-colors duration-150 flex items-center gap-1.5">
                                <span>Tiket Saya</span>
                                <span class="w-2 h-2 rounded-full bg-[#2563EB]"></span>
                            </a>
                        @endif
                        @if(auth()->user()->isPanitia())
                            <a href="{{ route('dashboard.index') }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-150 flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/30 text-xs">Panel Panitia</span>
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- Auth Buttons / User Profile -->
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white px-3.5 py-2 rounded-lg hover:bg-slate-800/60 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-[#2563EB] hover:bg-blue-600 px-4 py-2 rounded-lg shadow-sm shadow-blue-500/20 transition-all hover:shadow-blue-500/40">
                            Daftar Akun
                        </a>
                    @else
                        <div class="flex items-center space-x-3">
                            <div class="text-right hidden sm:block">
                                <div class="text-xs font-semibold text-white leading-none">{{ auth()->user()->name }}</div>
                                <div class="text-[11px] text-slate-400 capitalize">{{ auth()->user()->role }}</div>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-medium text-slate-400 hover:text-rose-400 p-2 rounded-lg hover:bg-slate-800/60 transition-colors" title="Keluar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border-b border-emerald-500/20 text-emerald-400 px-4 py-3 text-sm text-center font-medium backdrop-blur">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-500/10 border-b border-rose-500/20 text-rose-400 px-4 py-3 text-sm text-center font-medium backdrop-blur">
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div class="bg-blue-500/10 border-b border-blue-500/20 text-blue-400 px-4 py-3 text-sm text-center font-medium backdrop-blur">
            {{ session('info') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer (Linear / Notion Clean Minimalist) -->
    <footer class="border-t border-[#E2E8F0]/10 bg-[#080D17] text-slate-400 text-xs py-10 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="workshoptix logo" class="h-6 w-auto object-contain brightness-95">
                <span class="text-slate-600">/</span>
                <span>Platform Pendaftaran & Tiket Digital Workshop IT</span>
            </div>
            <div class="flex items-center space-x-6 text-slate-400 font-mono text-[11px]">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Midtrans Sandbox Ready
                </span>
                <span>Laravel 11 • Tailwind 4 • MySQL</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
