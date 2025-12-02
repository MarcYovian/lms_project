@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Jadwal</h2>

<form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block">Mata Pelajaran</label>
        <input type="text" name="mapel" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block">Nama Guru</label>
        <input type="text" name="guru" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block">Kelas</label>
        <input type="text" name="kelas" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block">Hari</label>
        <select name="hari" class="w-full border p-2 rounded">
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
        </select>
    </div>

    <div class="flex gap-4">
        <div>
            <label class="block">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="border p-2 rounded">
        </div>

        <div>
            <label class="block">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="border p-2 rounded">
        </div>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

@endsection
