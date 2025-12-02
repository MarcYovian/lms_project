<div class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 p-6">
    <h1 class="text-xl font-bold mb-8">LearnFlux</h1>

    @php
        $role = Auth::user()->role;
    @endphp

    <ul class="space-y-4">

        {{-- DASHBOARD --}}
        <li>
            <a href="{{ route('dashboard.' . ($role === 'kepala_sekolah' ? 'kepsek' : ($role === 'guru' ? 'guru' : ($role === 'siswa' ? 'siswa' : ($role === 'orang_tua' ? 'orangtua' : 'dinas'))))) }}"
                class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                @include('components.icons.dashboard')
                <span>Dashboard</span>
            </a>
        </li>

        {{-- MENU GURU --}}
        @if ($role === 'guru')
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.data-guru')
                    <span>Data Guru</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.jadwal')
                    <span>Jadwal</span>
                </a>
            </li>
        @endif

        {{-- MENU SISWA --}}
        @if ($role === 'siswa')
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.data-siswa')
                    <span>Data Siswa</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.nilai')
                    <span>Nilai</span>
                </a>
            </li>
        @endif

        {{-- MENU KEPALA SEKOLAH --}}
        @if ($role === 'kepala_sekolah')
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.laporan')
                    <span>Laporan Sekolah</span>
                </a>
            </li>
        @endif

        {{-- MENU DINAS --}}
        @if ($role === 'dinas')
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.dashboard-dinas')
                    <span>Dashboard Dinas</span>
                </a>
            </li>
        @endif

        {{-- MENU ORANGTUA --}}
        @if ($role === 'orang_tua')
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600">
                    @include('components.icons.profil')
                    <span>Profil Anak</span>
                </a>
            </li>
        @endif

        {{-- LOGOUT --}}
        <li class="pt-10">
            <a href="{{ route('logout') }}"
               class="flex items-center space-x-3 text-red-600 hover:text-red-800">
                @include('components.icons.logout')
                <span>Logout</span>
            </a>
        </li>

        {{-- GURU --}}
        <li>
            <a href="{{ route('guru.nilai') }}" class="sidebar-item">
                @include('components.icon.nilai')
                <span>Rekap Nilai</span>
            </a>
        </li>

        {{-- KEPSEK --}}
        <li>
            <a href="{{ route('kepsek.laporan') }}" class="sidebar-item">
                @include('components.icon.laporan')
                <span>Laporan Nilai</span>
            </a>
        </li>

        {{-- JADWAL GURU --}}
        <li>
            <a href="{{ route('guru.jadwal') }}" class="sidebar-item">
                @include('components.icon.jadwal')
                <span>Kelola Jadwal</span>
            </a>
        </li>

        {{-- JADWAL SISWA --}}
        <li>
            <a href="{{ route('siswa.jadwal') }}" class="sidebar-item">
                @include('components.icon.jadwal')
                <span>Jadwal Pelajaran</span>
            </a>
        </li>

        {{-- PESAN --}}
        <li>
            <a href="{{ route('chat.index') }}" class="sidebar-item">
                @include('components.icon.pesan')
                <span>Pesan</span>
            </a>
        </li>

        {{-- INPUT NILAI GURU --}}
        @if(Auth::user()->role == 'guru')
        <li>
            <a href="{{ route('nilai.index') }}" class="sidebar-item">
                @include('components.icon.nilai')
                <span>Input Nilai</span>
            </a>
        </li>
        @endif

        {{-- NILAI SISWA --}}
        @if(Auth::user()->role == 'siswa')
        <li>
            <a href="{{ route('nilai.siswa') }}" class="sidebar-item">
                @include('components.icon.nilai')
                <span>Nilai Saya</span>
            </a>
        </li>
        @endif

        @if(Auth::user()->role == 'guru')
<a href="{{ route('jadwal.index') }}" class="sidebar-item">
    @include('components.icon.jadwal')
    <span>Jadwal Pelajaran</span>
</a>
@endif

@if(Auth::user()->role == 'siswa')
<a href="{{ route('jadwal.siswa') }}" class="sidebar-item">
    @include('components.icon.jadwal')
    <span>Jadwal Kelas</span>
</a>
@endif

<li>
    <a href="{{ route('tugas.index') }}" class="flex items-center gap-3">
        @include('components.icons.file-upload')
        <span>Tugas</span>
    </a>
</li>

    </ul>
</div>
