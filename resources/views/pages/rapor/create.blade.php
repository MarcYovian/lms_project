@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Input Nilai Rapor</h2>

<form action="{{ route('rapor.store') }}" method="POST" class="space-y-4">
@csrf

<div>
    <label>Siswa</label>
    <select name="siswa_id" class="w-full border p-2 rounded">
        @foreach($siswa as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
    </select>
</div>

<div>
    <label>Semester</label>
    <select name="semester" class="w-full border p-2 rounded">
        <option>Semester 1</option>
        <option>Semester 2</option>
    </select>
</div>

<div>
    <label>Mata Pelajaran</label>
    <input name="mapel" class="w-full border p-2 rounded">
</div>

<div class="grid grid-cols-3 gap-4">
    <div>
        <label>Nilai Tugas</label>
        <input type="number" name="nilai_tugas" class="w-full border p-2 rounded">
    </div>
    <div>
        <label>Nilai UTS</label>
        <input type="number" name="nilai_uts" class="w-full border p-2 rounded">
    </div>
    <div>
        <label>Nilai UAS</label>
        <input type="number" name="nilai_uas" class="w-full border p-2 rounded">
    </div>
</div>

<div>
    <label>Catatan</label>
    <textarea name="catatan" class="w-full border p-2 rounded"></textarea>
</div>

<button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>

</form>

@endsection
