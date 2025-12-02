@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Nilai Saya</h2>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Mapel</th>
            <th class="p-3">Nilai</th>
            <th class="p-3">Tanggal</th>
        </tr>
    </thead>

    @foreach($nilai as $n)
    <tr class="border-b">
        <td class="p-3">{{ $n->mapel }}</td>
        <td class="p-3 font-semibold">{{ $n->nilai }}</td>
        <td class="p-3">{{ $n->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>

@endsection
