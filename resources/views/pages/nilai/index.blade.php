@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Daftar Nilai Yang Anda Input</h2>

<a href="{{ route('nilai.create') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Tambah Nilai
</a>

<div class="bg-white rounded shadow p-4">
    <table class="w-full table-auto">
        <thead class="border-b">
            <tr>
                <th class="py-2">Siswa</th>
                <th>Mapel</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @foreach($nilai as $n)
            <tr class="border-b">
                <td class="py-2">{{ $n->siswa->name }}</td>
                <td>{{ $n->mapel }}</td>
                <td>{{ $n->nilai }}</td>
                <td>{{ $n->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
