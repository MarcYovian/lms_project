@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-4">Rapor Semester</h2>

@if(Auth::user()->role == 'guru')
<a href="{{ route('rapor.create') }}" 
   class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
   + Input Nilai Rapor
</a>
@endif

<table class="w-full bg-white shadow rounded">
    <tr class="bg-gray-100 font-bold">
        <td class="p-2">Siswa</td>
        <td class="p-2">Mapel</td>
        <td class="p-2">Semester</td>
        <td class="p-2">Nilai Akhir</td>
        <td></td>
    </tr>

    @foreach($rapor as $r)
    <tr class="border-b">
        <td class="p-2">{{ $r->siswa_id }}</td>
        <td class="p-2">{{ $r->mapel }}</td>
        <td class="p-2">{{ $r->semester }}</td>
        <td class="p-2">{{ $r->nilai_akhir }}</td>
        <td class="p-2">
            <a href="{{ route('rapor.siswa', $r->siswa_id) }}" class="text-blue-600">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
