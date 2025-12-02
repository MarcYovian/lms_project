@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Input Absensi</h2>

<form action="{{ route('absensi.store') }}" method="POST" class="space-y-4">
    @csrf

    <label class="block">
        <span>Siswa</span>
        <select name="siswa_id" class="w-full border p-2 rounded">
            @foreach($siswa as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    </label>

    <label class="block">
        <span>Tanggal</span>
        <input type="date" name="tanggal" class="w-full border p-2 rounded">
    </label>

    <label class="block">
        <span>Status</span>
        <select name="status" class="w-full border p-2 rounded">
            <option value="hadir">Hadir</option>
            <option value="sakit">Sakit</option>
            <option value="izin">Izin</option>
            <option value="alpha">Alpha</option>
        </select>
    </label>

    <label class="block">
        <span>Keterangan</span>
        <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
    </label>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>
@endsection
