@extends('layouts.app')

@section('title', 'LearnFlux - Smart Learning Management System')

@section('content')
<section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-24 min-h-screen">
  <div class="max-w-6xl mx-auto px-6 text-center">

    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
      Selamat Datang di LearnFlux LMS
    </h1>
    <p class="text-lg text-gray-600 mb-12">
      Pilih peran Anda untuk masuk ke sistem
    </p>

    <div class="grid md:grid-cols-3 gap-8">

      {{-- Dinas --}}
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <x-icons.dinas class="w-16 h-16 text-blue-700" />
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Dinas Pendidikan</h3>
        <p class="text-gray-600 mb-6">Monitoring dan manajemen seluruh sekolah</p>
        <a href="{{ route('login.role', ['role' => 'dinas']) }}" class="block bg-blue-900 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
          Masuk Sebagai Dinas Pendidikan
        </a>
      </div>

      {{-- Kepala Sekolah --}}
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <x-icons.kepsek class="w-16 h-16 text-blue-700" />
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Kepala Sekolah</h3>
        <p class="text-gray-600 mb-6">Kelola kinerja guru dan monitoring siswa</p>
        <a href="{{ route('login.role', ['role' => 'kepala_sekolah']) }}" class="block bg-blue-900 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
          Masuk Sebagai Kepala Sekolah
        </a>
      </div>

      {{-- Guru --}}
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <x-icons.guru class="w-16 h-16 text-blue-700" />
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Guru</h3>
        <p class="text-gray-600 mb-6">Buat kelas, upload materi, dan kelola siswa</p>
        <a href="{{ route('login.role', ['role' => 'guru']) }}" class="block bg-blue-900 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
          Masuk Sebagai Guru
        </a>
      </div>

      {{-- Siswa --}}
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <x-icons.siswa class="w-16 h-16 text-blue-700" />
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Siswa</h3>
        <p class="text-gray-600 mb-6">Akses kelas, kerjakan tugas, dan ikuti ujian</p>
        <a href="{{ route('login.role', ['role' => 'siswa']) }}" class="block bg-blue-900 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
          Masuk Sebagai Siswa
        </a>
      </div>

      {{-- Orang Tua --}}
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <x-icons.orangtua class="w-16 h-16 text-blue-700" />
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Orang Tua</h3>
        <p class="text-gray-600 mb-6">Pantau perkembangan dan nilai anak</p>
        <a href="{{ route('login.role', ['role' => 'orang_tua']) }}" class="block bg-blue-900 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
          Masuk Sebagai Orang Tua
        </a>
      </div>

    </div>
  </div>
</section>

{{-- FOOTER --}}
<footer class="bg-gray-900 text-gray-300 py-8 text-center">
  <h3 class="text-xl font-semibold text-white">LearnFlux LMS</h3>
  <p class="text-gray-400 mt-2">© {{ date('Y') }} LearnFlux — Semua Hak Dilindungi</p>
</footer>
@endsection
