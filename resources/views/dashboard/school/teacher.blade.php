@extends('layouts.dashboard')

@section('content')
<div class="p-6 space-y-8">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
            <p class="text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
        <div class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Kelas Aktif -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="text-gray-500 font-medium text-sm">Total Kelas Aktif</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalActiveCourses }}</h3>
                <p class="text-xs text-gray-400 mt-1">Tahun Ajaran Aktif</p>
            </div>
        </div>

        <!-- Card 2: Total Siswa Diajar -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="text-gray-500 font-medium text-sm">Total Siswa</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalStudents }}</h3>
                <p class="text-xs text-gray-400 mt-1">Siswa Unik</p>
            </div>
        </div>

        <!-- Card 3: Tugas Aktif -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <span class="text-gray-500 font-medium text-sm">Tugas Aktif</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $activeAssignmentsCount }}</h3>
                <p class="text-xs text-gray-400 mt-1">Deadline > Hari Ini</p>
            </div>
        </div>

        <!-- Card 4: Rata-rata Kehadiran -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-gray-500 font-medium text-sm">Rata-rata Kehadiran</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $averageAttendance }}%</h3>
                <p class="text-xs text-gray-400 mt-1">Seluruh Pertemuan</p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Total Siswa per Kelas</h3>
        <div class="h-64">
            <canvas id="studentsChart"></canvas>
        </div>
    </div>

    <!-- Active Courses Section -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Kelas Aktif</h3>
            <a href="{{ route('teacher.courses.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($activeCourses as $course)
            <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="flex items-start justify-between mb-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            {{ substr($course->classroom->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $course->subject->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $course->classroom->name }}</p>
                        </div>
                    </div>
                    <div class="px-3 py-1 bg-gray-50 text-gray-500 text-xs font-semibold rounded-full border border-gray-100">
                        {{ $course->code }}
                    </div>
                </div>

                <div class="mt-auto pt-5 border-t border-gray-50 flex items-center justify-between">
                    <div class="flex items-center gap-4 text-xs font-medium text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            {{ $course->classroom->students_count }} Siswa
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            {{ $course->materials_count }} Materi
                        </span>
                    </div>
                    <a href="{{ route('teacher.courses.show', $course->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all transform group-hover:rotate-45">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10 bg-gray-50 rounded-xl">
                <p class="text-gray-500 italic">Belum ada kelas aktif.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pending Grading Section -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Perlu Dinilai</h3>
            <span class="px-3 py-1 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-full">{{ $pendingGrading->count() }} Tugas</span>
        </div>
        
        @if($pendingGrading->isEmpty())
        <div class="p-8 text-center text-gray-500">
            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p>Bagus! Tidak ada tugas yang perlu dinilai saat ini.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Tugas</th>
                        <th class="px-6 py-4 font-semibold">Kelas & Mapel</th>
                        <th class="px-6 py-4 font-semibold">Deadline</th>
                        <th class="px-6 py-4 font-semibold text-center">Menunggu Penilaian</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pendingGrading as $assignment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $assignment->title }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">{{ $assignment->course->classroom->name }}</span>
                                <span class="text-xs text-gray-500">{{ $assignment->course->subject->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ \Carbon\Carbon::parse($assignment->due_date)->isPast() ? 'text-red-500 font-bold' : 'text-gray-600' }}">
                                {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ $assignment->pending_count }} Siswa
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('tugas.show', $assignment->id) }}" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">Nilai Sekarang</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('studentsChart').getContext('2d');
        const data = @json($studentsPerClass);
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.class_name),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: data.map(item => item.student_count),
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', // Blue-500
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1,
                    borderRadius: 8,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
