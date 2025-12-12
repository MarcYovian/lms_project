@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelas Saya</h1>
            <p class="text-gray-500 mt-2">Kelola materi, tugas, ve pantau perkembangan siswa Anda di sini.</p>
        </div>
    </div>

    @if($courses->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
        <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900">Belum ada kelas</h3>
        <p class="text-gray-500 mt-1 max-w-sm mx-auto">Anda belum ditugaskan untuk mengajar di kelas manapun saat ini.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative overflow-hidden">
            <!-- Decorative Gradient Top -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            <div class="flex items-start justify-between mb-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 mb-1">
                            {{ $course->classroom->name }}
                        </span>
                        <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1" title="{{ $course->subject->name }}">
                            {{ $course->subject->name }}
                        </h3>
                    </div>
                </div>
            </div>

            <p class="text-sm text-gray-500 mb-6 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                {{ $course->classroom->school->name ?? 'Sekolah' }}
                <span>•</span>
                {{ $course->academicYear->name ?? 'TA' }}
            </p>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 rounded-xl p-3 flex flex-col items-center justify-center border border-gray-100 group-hover:border-blue-100 transition-colors">
                    <span class="text-2xl font-black text-gray-900">{{ $course->classroom->students_count }}</span>
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider mt-1">Siswa</span>
                </div>
                <div class="bg-gray-50 rounded-xl p-3 flex flex-col items-center justify-center border border-gray-100 group-hover:border-blue-100 transition-colors">
                    <span class="text-2xl font-black text-gray-900">{{ $course->materials_count }}</span>
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider mt-1">Materi</span>
                </div>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-100">
                <a href="{{ route('teacher.courses.show', $course->id) }}" class="flex items-center justify-center w-full bg-gray-900 hover:bg-blue-600 text-white font-medium py-2.5 px-4 rounded-xl transition-all duration-200 shadow-lg shadow-gray-200 hover:shadow-blue-200 group-hover:translate-y-0">
                    <span>Kelola Kelas</span>
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
