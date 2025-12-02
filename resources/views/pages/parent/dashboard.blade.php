@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-6">Monitoring Anak</h2>

<div class="grid grid-cols-3 gap-5">

@foreach($anak as $a)
    <a href="{{ route('parent.detail', $a->id) }}"
       class="bg-white p-6 shadow rounded hover:shadow-lg transition">
       
        <h3 class="text-lg font-semibold">{{ $a->name }}</h3>
        <p class="text-gray-600 text-sm">Kelas: {{ $a->kelas ?? '-' }}</p>
        <p class="mt-2 text-blue-600 text-sm">Klik untuk melihat detail →</p>

    </a>
@endforeach

</div>

@endsection
