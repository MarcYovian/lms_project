@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Buat Topik Diskusi</h1>

    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl shadow">
        @csrf

        <div>
            <label class="font-medium">Judul Topik</label>
            <input type="text" name="judul"
                class="w-full mt-2 p-3 border rounded-lg"
                required>
        </div>

        <div class="mt-4">
            <label class="font-medium">Isi Diskusi</label>
            <textarea name="konten" rows="6"
                class="w-full mt-2 p-3 border rounded-lg"
                required></textarea>
        </div>

        <div class="mt-4">
            <label class="font-medium">Lampiran (opsional)</label>
            <input type="file" name="lampiran"
                class="mt-2">
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('forum.index') }}"
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Batal
            </a>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Topik
            </button>
        </div>

    </form>
</div>
@endsection
