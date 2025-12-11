@extends('layouts.dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold">Input Absensi</h2>
    <p class="text-gray-600">
        Mata Pelajaran: <strong>{{ $course->subject->name }}</strong> - 
        Kelas: <strong>{{ $course->classroom->name }}</strong>
    </p>
    <p class="text-gray-600">Tanggal: <strong>{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}</strong></p>
</div>

<form action="{{ route('absensi.store') }}" method="POST" class="bg-white shadow rounded-xl overflow-hidden">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}">
    <input type="hidden" name="date" value="{{ $date }}">

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Siswa</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 w-1/2">Status Kehadiran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($students as $student)
                @php
                    $status = $existing[$student->id]->status ?? 'hadir'; // Default hadir
                @endphp
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $student->nama }}
                        <div class="text-xs text-gray-400 font-normal">{{ $student->nis }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="hadir" class="form-radio text-green-600 focus:ring-green-500" {{ $status == 'hadir' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Hadir</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="sakit" class="form-radio text-yellow-500 focus:ring-yellow-400" {{ $status == 'sakit' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Sakit</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="izin" class="form-radio text-blue-500 focus:ring-blue-400" {{ $status == 'izin' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Izin</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="alpha" class="form-radio text-red-600 focus:ring-red-500" {{ $status == 'alpha' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Alpha</span>
                            </label>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-6 bg-gray-50 border-t flex justify-end">
        <a href="{{ route('absensi.index') }}" class="mr-4 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 font-medium">Batal</a>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow-md">
            Simpan Absensi
        </button>
    </div>
</form>
@endsection
