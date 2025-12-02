@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar Tugas</h2>

@if(Auth::user()->role == 'guru')
<a href="{{ route('tugas.create') }}" 
   class="px-4 py-2 bg-blue-600 text-white rounded inline-block mb-4">
   + Buat Tugas
</a>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
@foreach($tugas as $t)
    <div class="p-4 bg-white shadow rounded">
        <h3 class="font-bold text-lg">{{ $t->judul }}</h3>
        <p class="text-sm text-gray-600">Kelas: {{ $t->kelas }}</p>
        <p class="text-sm text-gray-600">Deadline: {{ $t->deadline }}</p>

        <a href="{{ route('tugas.show', $t->id) }}" 
           class="mt-3 inline-block text-blue-600">
            Lihat Detail →
        </a>
    </div>
@endforeach
</div>

@endsection
