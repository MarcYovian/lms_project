@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">{{ $tugas->judul }}</h2>

<p class="mb-2"><strong>Kelas:</strong> {{ $tugas->kelas }}</p>
<p><strong>Deadline:</strong> {{ $tugas->deadline }}</p>

<hr class="my-4">

<h3 class="text-lg font-semibold mb-2">Deskripsi Tugas</h3>
<p class="mb-4">{{ $tugas->deskripsi }}</p>

{{-- SISWA UPLOAD --}}
@if(Auth::user()->role == 'siswa')
<form action="{{ route('tugas.upload', $tugas->id) }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="space-y-3">

    @csrf

    <input type="file" name="file" class="border p-2 rounded w-full">

    <button class="px-4 py-2 bg-green-600 text-white rounded">
        Upload Tugas
    </button>
</form>
@endif

{{-- GURU MENILAI --}}
@if(Auth::user()->role == 'guru')
<h3 class="text-xl font-bold mt-6 mb-3">Pengumpulan Siswa</h3>

@foreach($tugas->pengumpulan as $p)
<div class="border p-4 rounded mb-3">
    <p><strong>Siswa ID:</strong> {{ $p->siswa_id }}</p>

    <a href="{{ asset('storage/' . $p->file_path) }}" 
       class="text-blue-600 underline" download>
       Download File
    </a>

    <form action="{{ route('pengumpulan.nilai', $p->id) }}" method="POST" class="mt-3">
        @csrf

        <input type="number" name="nilai" placeholder="Nilai"
               class="border p-2 rounded w-24">

        <input type="text" name="catatan" placeholder="Catatan"
               class="border p-2 rounded w-64">

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan Nilai
        </button>
    </form>
</div>
@endforeach
@endif

@endsection
