@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Rekap Absensi</h2>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absensi as $a)
        <tr class="border-b">
            <td class="p-3">{{ $a->siswa->name }}</td>
            <td class="p-3">{{ $a->tanggal }}</td>
            <td class="p-3 capitalize">{{ $a->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $absensi->links() }}

@endsection
