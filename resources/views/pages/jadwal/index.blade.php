@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Jadwal Pelajaran</h2>

@if(Auth::user()->role != 'siswa')
<a href="{{ route('jadwal.create') }}" 
   class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
   + Tambah Jadwal
</a>
@endif

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Mapel</th>
            <th class="p-3">Guru</th>
            <th class="p-3">Kelas</th>
            <th class="p-3">Hari</th>
            <th class="p-3">Jam</th>
            @if(Auth::user()->role != 'siswa')
            <th class="p-3">Aksi</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach($jadwals as $j)
        <tr class="border-b">
            <td class="p-3">{{ $j->mapel }}</td>
            <td class="p-3">{{ $j->guru }}</td>
            <td class="p-3">{{ $j->kelas }}</td>
            <td class="p-3">{{ $j->hari }}</td>
            <td class="p-3">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>

            @if(Auth::user()->role != 'siswa')
            <td class="p-3">
                <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                        Hapus
                    </button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
