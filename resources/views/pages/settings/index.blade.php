@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Pengaturan Akun</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="font-semibold mb-3">Profil</h2>
        <form action="{{ route('settings.profile') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm">Nama</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm">Email</label>
                <input name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded" required>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Profil</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold mb-3">Ganti Password</h2>
        <form action="{{ route('settings.password') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm">Password Saat Ini</label>
                <input name="current_password" type="password" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm">Password Baru</label>
                <input name="password" type="password" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="w-full p-2 border rounded" required>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Ganti Password</button>
        </form>
    </div>
</div>
@endsection
