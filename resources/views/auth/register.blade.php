@extends('layouts.app')

@section('title', 'Daftar Akun Baru — WORKSHOPTIX')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="p-8 rounded-3xl bg-[#0f172a] border border-[#E2E8F0]/15 shadow-2xl">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-white tracking-tight">Daftar Akun Peserta</h1>
                <p class="text-xs text-slate-400 mt-1 font-mono">Mulai pesan tiket workshop IT impianmu</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-medium text-slate-300 mb-1">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                    @error('name')
                        <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                    @error('email')
                        <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-slate-300 mb-1">Kata Sandi (Min. 8 Karakter)</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                    @error('password')
                        <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-slate-300 mb-1">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                </div>

                <button type="submit" class="w-full mt-4 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-[#2563EB] hover:bg-blue-600 transition-all shadow-lg shadow-blue-500/25">
                    Buat Akun Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-[#E2E8F0]/10 text-center text-xs text-slate-400">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-semibold text-blue-400 hover:underline">Masuk</a>
            </div>
        </div>
    </div>
</div>
@endsection
