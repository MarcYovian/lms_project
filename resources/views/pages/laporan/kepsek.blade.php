@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Laporan Nilai Siswa - Rekap Keseluruhan</h2>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Nama Siswa</th>
            <th class="p-3">Rata-rata Nilai</th>
            <th class="p-3">Jumlah Penilaian</th>
        </tr>
    </thead>

    @foreach($rekap as $r)
    <tr class="border-b">
        <td class="p-3">{{ $r->name }}</td>
        <td class="p-3">{{ number_format($r->nilai_avg, 2) }}</td>
        <td class="p-3">{{ $r->nilai_count }}</td>
    </tr>
    @endforeach
</table>

@endsection
