@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Dashboard Guru</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Kartu Jumlah Siswa --}}
        <div class="bg-white shadow rounded-xl p-6 flex items-center space-x-4">
            @include('components.icons.data-siswa')
            <div>
                <h2 class="font-bold text-xl">{{ $totalStudents }}</h2>
                <p class="text-gray-500">Total Siswa</p>
            </div>
        </div>

        {{-- Kartu Jumlah Mapel --}}
        <div class="bg-white shadow rounded-xl p-6 flex items-center space-x-4">
            {{-- Icon placeholder or reuse --}}
            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-xl">{{ $totalCourses }}</h2>
                <p class="text-gray-500">Mata Pelajaran</p>
            </div>
        </div>
    </div>

    {{-- Jadwal Hari Ini --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-bold mb-4">Jadwal Hari Ini ({{ \Carbon\Carbon::now()->format('l') }})</h2>
        @if($schedules->isEmpty())
            <p class="text-gray-500">Tidak ada jadwal mengajar hari ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="py-2">Jam</th>
                            <th class="py-2">Kelas</th>
                            <th class="py-2">Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr class="border-b last:border-0 hover:bg-gray-50">
                            <td class="py-3">{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}</td>
                            <td class="py-3">{{ $schedule->course->classroom->name }}</td>
                            <td class="py-3">{{ $schedule->course->subject->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
