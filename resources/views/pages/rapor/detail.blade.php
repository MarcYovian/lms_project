@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">
    Rapor Semester — {{ $siswa->name }}
</h2>

<table class="w-full bg-white shadow rounded mb-6">
    <tr class="bg-gray-100 font-bold">
        <td class="p-2">Mapel</td>
        <td class="p-2">Tugas</td>
        <td class="p-2">UTS</td>
        <td class="p-2">UAS</td>
        <td class="p-2">Akhir</td>
        <td class="p-2">Catatan</td>
    </tr>

    @foreach($rapor as $r)
    <tr class="border-b">
        <td class="p-2">{{ $r->mapel }}</td>
        <td class="p-2">{{ $r->nilai_tugas }}</td>
        <td class="p-2">{{ $r->nilai_uts }}</td>
        <td class="p-2">{{ $r->nilai_uas }}</td>
        <td class="p-2 font-bold">{{ $r->nilai_akhir }}</td>
        <td class="p-2">{{ $r->catatan }}</td>
    </tr>
    @endforeach
</table>

<a href="{{ route('rapor.pdf', $siswa->id) }}"
   class="px-4 py-2 bg-blue-600 text-white rounded">
   Download PDF
</a>

@endsection
