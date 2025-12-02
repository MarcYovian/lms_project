@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Buat Akun</h2>

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
      @csrf

      <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full border rounded-lg px-3 py-2">
      <input type="email" name="email" placeholder="Email" required class="w-full border rounded-lg px-3 py-2">
      <input type="password" name="password" placeholder="Password (Min 6 Karakter)" minlength="6" required class="w-full border rounded-lg px-3 py-2">

      <select name="role" class="w-full border rounded-lg px-3 py-2" required>
        <option value="">-- Pilih Peran --</option>
        <option value="dinas">Dinas Pendidikan</option>
        <option value="kepala_sekolah">Kepala Sekolah</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
        <option value="orang_tua">Orang Tua</option>
      </select>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold">
        Daftar
      </button>
    </form>
  </div>
</div>
@endsection
