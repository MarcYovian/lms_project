@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <h1 class="text-2xl font-semibold mb-4">Edit Pengumuman</h1>

    <form action="{{ route('pengumuman.update', $peng->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow">

        @csrf

        {{-- JUDUL --}}
        <label class="block font-medium">Judul</label>
        <input 
            name="judul" 
            value="{{ old('judul', $peng->judul) }}" 
            class="w-full border p-2 rounded mb-4" 
            required>

        {{-- ISI PENGUMUMAN --}}
        <label class="block font-medium">Isi</label>
        <textarea 
            name="isi" 
            rows="8" 
            class="w-full border p-2 rounded mb-4" 
            required>{{ old('isi', $peng->isi) }}</textarea>

        {{-- LAMPIRAN LAMA --}}
        @if ($peng->lampiran)
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-1">Lampiran sekarang:</p>
                <a href="{{ route('pengumuman.download', $peng->id) }}" class="text-blue-600 underline">
                    Download lampiran lama
                </a>
            </div>
        @endif

        {{-- UPLOAD LAMPIRAN BARU --}}
        <label class="block font-medium">Ganti Lampiran (opsional)</label>
        <input type="file" name="lampiran" class="mb-4">

        {{-- TANGGAL PUBLISH --}}
        <label class="block font-medium">Publikasikan Pada (opsional)</label>
        <input 
            type="datetime-local" 
            name="publish_at"
            value="{{ old('publish_at', $peng->publish_at ? $peng->publish_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full border p-2 rounded mb-4">

        {{-- STATUS --}}
        <label class="flex items-center gap-2 mb-4">
            <input type="checkbox" name="is_published" 
                {{ $peng->is_published ? 'checked' : '' }}>
            <span>Pengumuman dipublikasikan</span>
        </label>

        {{-- TOMBOL --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('pengumuman.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                Batal
            </a>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>
        </div>

    </form>

</div>
@endsection
