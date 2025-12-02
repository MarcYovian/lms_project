@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Dashboard Dinas Pendidikan</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Data Sekolah --}}
        <div class="bg-white shadow rounded-xl p-6 flex items-center space-x-4">
            @include('components.icons.dashboard-dinas')
            <div>
                <h2 class="font-bold text-xl">28</h2>
                <p class="text-gray-500">Sekolah Terdaftar</p>
            </div>
        </div>

        {{-- Laporan Masuk --}}
        <div class="bg-white shadow rounded-xl p-6 flex items-center space-x-4">
            @include('components.icons.laporan')
            <div>
                <h2 class="font-bold text-xl">150</h2>
                <p class="text-gray-500">Laporan Bulan Ini</p>
            </div>
        </div>

        {{-- Notifikasi --}}
        <div class="bg-white shadow rounded-xl p-6 flex items-center space-x-4">
            @include('components.icons.notifikasi')
            <div>
                <h2 class="font-bold text-xl">4</h2>
                <p class="text-gray-500">Notifikasi Baru</p>
            </div>
        </div>

    </div>
</div>
@endsection
