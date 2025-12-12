@extends('layouts.dashboard')

@section('content')
@if(auth()->user()->role == \App\Enums\UserRole::GURU)
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">Input Absensi Siswa</h2>
        <form action="{{ route('absensi.create') }}" method="GET" class="space-y-6">
            <div>
                <label class="block mb-2 font-medium">Mata Pelajaran & Kelas</label>
                <select name="course_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->subject->name }} - {{ $course->classroom->name }} ({{ $course->classroom->school->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block mb-2 font-medium">Tanggal</label>
                <input type="date" name="date" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ date('Y-m-d') }}" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Lanjut
            </button>
        </form>
    </div>
@else
    <h2 class="text-2xl font-bold mb-4">Rekap Absensi</h2>

    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Kelas</th>
                    <th class="p-3 text-left">Mata Pelajaran</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $a)
                <tr class="border-b">
                    {{-- Handle if student/course is deleted safely --}}
                    <td class="p-3">{{ $a->student->nama ?? '-' }}</td>
                    <td class="p-3">{{ $a->course->classroom->name ?? '-' }}</td>
                    <td class="p-3">{{ $a->course->subject->name ?? '-' }}</td>
                    <td class="p-3">{{ $a->date ? $a->date->format('d/m/Y') : '-' }}</td>
                    <td class="p-3 capitalize">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $a->status == 'hadir' ? 'bg-green-100 text-green-800' : 
                               ($a->status == 'sakit' ? 'bg-yellow-100 text-yellow-800' : 
                               ($a->status == 'izin' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                            {{ $a->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $absensi->links() }}
    </div>
@endif

@endsection
