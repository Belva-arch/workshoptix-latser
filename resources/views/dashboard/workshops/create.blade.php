@extends('layouts.app')

@section('title', 'Tambah Workshop Baru — WORKSHOPTIX')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6">
        <a href="{{ route('dashboard.workshops') }}" class="hover:text-white">Workshop</a>
        <span>/</span>
        <span class="text-blue-400">Tambah Baru</span>
    </div>

    <div class="p-8 rounded-3xl bg-[#0f172a] border border-[#E2E8F0]/15 shadow-2xl">
        <h1 class="text-2xl font-bold text-white mb-6">Buat Workshop IT Baru</h1>

        <form action="{{ route('dashboard.workshops.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Judul Workshop</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                @error('title') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Kategori</label>
                    <select name="category" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">
                        <option value="Web Development">Web Development</option>
                        <option value="Cyber Security">Cyber Security</option>
                        <option value="Cloud & DevOps">Cloud & DevOps</option>
                        <option value="Artificial Intelligence">Artificial Intelligence</option>
                        <option value="Mobile Development">Mobile Development</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Lokasi Sesi</label>
                    <input type="text" name="location" value="{{ old('location', 'Lab Komputer RPL') }}" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Nama Instruktur</label>
                    <input type="text" name="instructor" value="{{ old('instructor') }}" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Gelar / Posisi Instruktur</label>
                    <input type="text" name="instructor_title" value="{{ old('instructor_title') }}" placeholder="cth: Senior Lead Software Engineer" class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Waktu Mulai</label>
                    <input type="datetime-local" name="start_time" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Waktu Selesai</label>
                    <input type="datetime-local" name="end_time" class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Harga Tiket (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', 50000) }}" min="0" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-300 mb-1">Kuota Kursi</label>
                    <input type="number" name="quota" value="{{ old('quota', 30) }}" min="1" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">URL Cover Image</label>
                <input type="url" name="image" value="{{ old('image') }}" placeholder="https://images.unsplash.com/..." class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1">Deskripsi & Materi</label>
                <textarea name="description" rows="4" required class="w-full px-3.5 py-2.5 bg-[#0B1220] border border-[#E2E8F0]/15 rounded-xl text-sm text-white focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('dashboard.workshops') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white bg-[#2563EB] hover:bg-blue-600 shadow-md">Simpan Workshop</button>
            </div>
        </form>
    </div>
</div>
@endsection
