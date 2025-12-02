@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Buat Tugas Baru</h2>

<form action="{{ route('tugas.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Judul Tugas</label>
        <input name="judul" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 rounded"></textarea>
    </div>

    <div>
        <label>Kelas</label>
        <input name="kelas" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Deadline</label>
        <input type="date" name="deadline" class="w-full border p-2 rounded">
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

@endsection
