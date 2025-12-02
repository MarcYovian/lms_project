@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Jadwal Kelas {{ $kelas }}</h2>

<div class="bg-white rounded shadow p-4">
    <table class="w-full table-auto">
        <thead class="border-b">
            <tr>
                <th class="py-2">Mapel</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Guru</th>
            </tr>
        </thead>

        <tbody>
            @foreach($jadwal as $j)
            <tr class="border-b">
                <td>{{ $j->mapel }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                <td>{{ $j->guru->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
