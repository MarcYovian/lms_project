@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-6">Detail Anak — {{ $siswa->name }}</h2>

<div class="grid grid-cols-2 gap-6">

    {{-- Absensi --}}
    <div class="bg-white p-5 shadow rounded">
        <h3 class="font-semibold text-lg mb-3">Absensi</h3>
        <ul class="text-sm">
            @foreach($absensi as $a)
                <li class="border-b py-1">
                    {{ $a->tanggal }} — 
                    <span class="font-semibold">{{ ucfirst($a->status) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Nilai --}}
    <div class="bg-white p-5 shadow rounded">
        <h3 class="font-semibold text-lg mb-3">Nilai</h3>
        <ul class="text-sm">
            @foreach($nilai as $n)
                <li class="border-b py-1">
                    {{ $n->mapel }}: 
                    <span class="font-semibold">{{ $n->nilai }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Tugas --}}
    <div class="bg-white p-5 shadow rounded">
        <h3 class="font-semibold text-lg mb-3">Tugas</h3>
        <ul class="text-sm">
            @foreach($tugas as $t)
                <li class="border-b py-1">
                    {{ $t->judul }} — 
                    <span class="text-gray-600">
                        {{ $t->status }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Pembayaran SPP --}}
    <div class="bg-white p-5 shadow rounded">
        <h3 class="font-semibold text-lg mb-3">Pembayaran SPP</h3>
        <ul class="text-sm">
            @foreach($spp as $s)
                <li class="border-b py-1">
                    {{ $s->bulan }} — 
                    <span class="font-semibold">{{ ucfirst($s->status) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>

@endsection
