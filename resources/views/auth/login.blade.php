@extends('layouts.app')

@section('title', 'Masuk Akun — WORKSHOPTIX')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Card (Linear Clean Box) -->
        <div class="p-8 rounded-3xl bg-[#0f172a] border border-[#E2E8F0]/15 shadow-2xl">
            <div class="text-center mb-6">
                <a href="{{ route('workshops.index') }}" class="inline-block mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="workshoptix logo" class="h-8 w-auto mx-auto object-contain">
                </a>
                <h1 class="text-xl font-bold text-white tracking-tight">Masuk ke WORKSHOPTIX</h1>
                <p class="text-xs text-slate-400 mt-1 font-mono">Platform Workshop IT & Digital Ticketing</p>
            </div>

            <!-- Demo Account Helper Box -->
            <div class="mb-6 p-3.5 rounded-2xl bg-[#0B1220]/80 border border-blue-500/20 text-xs text-slate-300">
                <span class="font-bold text-blue-400 block mb-1 font-mono">Akun Uji Coba LKPD:</span>
                <div class="font-mono text-[11px] space-y-0.5">
                    <div><span class="text-slate-400">Panitia:</span> <button type="button" onclick="fillCreds('panitia@workshoptix.id', 'password123')" class="text-blue-400 hover:underline">panitia@workshoptix.id</button></div>
                    <div><span class="text-slate-400">Peserta:</span> <button type="button" onclick="fillCreds('peserta@workshoptix.id', 'password123')" class="text-blue-400 hover:underline">peserta@workshoptix.id</button></div>
                    <div class="text-slate-500">Password: password123</div>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                    @error('email')
                        <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-medium text-slate-300">Kata Sandi</label>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-[#2563EB] focus:ring-0">
                        <span class="text-xs text-slate-400">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full mt-2 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-lg shadow-blue-500/25">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-[#E2E8F0]/10 text-center text-xs text-slate-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-semibold text-blue-400 hover:underline">Daftar Akun Baru</a>
            </div>
        </div>
    </div>
</div>

<script>
    function fillCreds(email, pass) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = pass;
    }
</script>
@endsection
