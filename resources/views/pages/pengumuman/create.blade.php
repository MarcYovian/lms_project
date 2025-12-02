@extends('layouts.dashboard')
@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Buat Pengumuman</h1>

    <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <label class="block font-medium">Judul</label>
        <input name="judul" class="w-full border p-2 rounded mb-4" required>

        <label class="block font-medium">Isi</label>
        <textarea name="isi" rows="8" class="w-full border p-2 rounded mb-4" required></textarea>

        <label class="block font-medium">Lampiran (opsional)</label>
        <input type="file" name="lampiran" class="mb-4">

        <label class="block font-medium">Publikasikan pada (opsional)</label>
        <input type="datetime-local" name="publish_at" class="w-full border p-2 rounded mb-4">

        <div class="flex justify-end gap-3">
            <a href="{{ route('pengumuman.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
