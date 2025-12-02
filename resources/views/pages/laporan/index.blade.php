@extends('layouts.dashboard')

@section('content')

<div class="p-6">
    
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Laporan</h1>

        <button 
            onclick="document.getElementById('modalAdd').classList.remove('hidden')"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Tambah Laporan
        </button>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="mb-4">
        <select name="kategori" onchange="this.form.submit()" class="p-2 border rounded">
            <option value="">-- Semua Kategori --</option>
            <option value="kegiatan" {{ $kategori=='kegiatan'?'selected':'' }}>Kegiatan</option>
            <option value="guru" {{ $kategori=='guru'?'selected':'' }}>Guru</option>
            <option value="siswa" {{ $kategori=='siswa'?'selected':'' }}>Siswa</option>
            <option value="keuangan" {{ $kategori=='keuangan'?'selected':'' }}>Keuangan</option>
        </select>
    </form>

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="min-w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Dibuat Oleh</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Lampiran</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reports as $report)
                <tr class="border-b">
                    <td class="p-3">{{ $report->judul }}</td>
                    <td class="p-3 capitalize">{{ $report->kategori }}</td>
                    <td class="p-3">{{ $report->user->name }}</td>
                    <td class="p-3">{{ $report->created_at->format('d M Y') }}</td>

                    <td class="p-3">
                        @if($report->lampiran)
                            <a 
                                href="{{ route('laporan.download', $report->id) }}"
                                class="text-blue-600 underline">
                                Download
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>

                    <td class="p-3">
                        <form action="{{ route('laporan.delete', $report->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>

</div>


{{-- MODAL TAMBAH --}}
<div id="modalAdd" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">

    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="text-xl font-semibold mb-3">Tambah Laporan</h2>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input name="judul" class="w-full p-2 border rounded mb-3" placeholder="Judul" required>

            <select name="kategori" class="w-full p-2 border rounded mb-3">
                <option value="kegiatan">Kegiatan</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
                <option value="keuangan">Keuangan</option>
            </select>

            <textarea name="deskripsi" class="w-full p-2 border rounded mb-3" placeholder="Deskripsi"></textarea>

            <label class="block mb-1">Lampiran (PDF/JPG/PNG)</label>
            <input type="file" name="lampiran" class="w-full mb-4">

            <div class="flex justify-end space-x-2">
                <button 
                    type="button"
                    onclick="document.getElementById('modalAdd').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">
                    Batal
                </button>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>

        </form>

    </div>

</div>

@endsection 
