@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Nilai Saya</h2>

<div class="bg-white rounded shadow p-4">
    <table class="w-full table-auto">
        <thead class="border-b">
            <tr>
                <th class="py-2">Mapel</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Guru</th>
            </tr>
        </thead>

        <tbody>
            @foreach($nilai as $n)
            <tr class="border-b">
                <td class="py-2">{{ $n->mapel }}</td>
                <td>{{ $n->nilai }}</td>
                <td>{{ $n->keterangan }}</td>
                <td>{{ $n->guru->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
