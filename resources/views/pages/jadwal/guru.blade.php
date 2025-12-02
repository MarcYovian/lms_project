@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Kelola Jadwal Pelajaran</h2>

{{-- Form tambah --}}
<form action="{{ route('guru.jadwal.store') }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
    @csrf

    <div class="grid grid-cols-2 gap-4">
        <input type="text" name="mapel" placeholder="Mata Pelajaran" class="input">
        <input type="text" name="guru" placeholder="Nama Guru" class="input">

        <select name="hari" class="input">
            <option value="">Pilih Hari</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
        </select>

        <input type="time" name="jam_mulai" class="input">
        <input type="time" name="jam_selesai" class="input">
    </div>

    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Tambah</button>
</form>

{{-- Tabel jadwal --}}
<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Mapel</th>
            <th class="p-3">Guru</th>
            <th class="p-3">Hari</th>
            <th class="p-3">Jam</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    @foreach($jadwal as $j)
    <tr class="border-b">
        <td class="p-3">{{ $j->mapel }}</td>
        <td class="p-3">{{ $j->guru }}</td>
        <td class="p-3">{{ $j->hari }}</td>
        <td class="p-3">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
        <td class="p-3">
            <form action="{{ route('guru.jadwal.delete', $j->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="text-red-600">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
