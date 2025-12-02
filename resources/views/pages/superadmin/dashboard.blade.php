@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-6">Dashboard Superadmin (Dinas Pendidikan)</h2>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">Total Siswa</p>
        <h3 class="text-3xl font-bold">{{ $total_siswa }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">Total Guru</p>
        <h3 class="text-3xl font-bold">{{ $total_guru }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">Total Orang Tua</p>
        <h3 class="text-3xl font-bold">{{ $total_orangtua }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">Absensi Hari Ini</p>
        <h3 class="text-3xl font-bold">{{ $absensi_hari_ini }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5 col-span-2">
        <p class="text-gray-600">Rata-rata Nilai</p>
        <h3 class="text-3xl font-bold">{{ number_format($nilai_rata,2) }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">SPP Lunas</p>
        <h3 class="text-3xl font-bold">{{ $spp_lunas }}</h3>
    </div>

    <div class="bg-white shadow rounded p-5">
        <p class="text-gray-600">SPP Belum Bayar</p>
        <h3 class="text-3xl font-bold">{{ $spp_belum }}</h3>
    </div>

</div>

@endsection
