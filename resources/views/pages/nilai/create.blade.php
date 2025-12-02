@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Input Nilai Siswa</h2>

<div class="bg-white p-6 rounded shadow w-full max-w-xl">

    <form method="POST" action="{{ route('nilai.store') }}">
        @csrf

        <label class="block mb-2 font-medium">Pilih Siswa</label>
        <select name="siswa_id" class="w-full border p-2 rounded mb-4">
            @foreach($siswa as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>

        <label class="block font-medium">Mata Pelajaran</label>
        <input type="text" name="mapel" class="w-full border p-2 rounded mb-4">

        <label class="block font-medium">Nilai</label>
        <input type="number" name="nilai" min="0" max="100" class="w-full border p-2 rounded mb-4">

        <label class="block font-medium">Keterangan</label>
        <textarea name="keterangan" class="w-full border p-2 rounded mb-4"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan Nilai
        </button>
    </form>

</div>
@endsection
