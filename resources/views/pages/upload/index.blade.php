@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-semibold">Upload File</h1>

        <button onclick="document.getElementById('modalUpload').classList.remove('hidden')"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            + Upload File
        </button>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="mb-6">
        <select name="kategori" onchange="this.form.submit()" class="border p-2 rounded">
            <option value="">Semua Kategori</option>
            <option value="materi" {{ $kategori=='materi' ? 'selected':'' }}>Materi</option>
            <option value="tugas" {{ $kategori=='tugas' ? 'selected':'' }}>Tugas</option>
            <option value="umum" {{ $kategori=='umum' ? 'selected':'' }}>Umum</option>
        </select>
    </form>

    {{-- LIST FILE --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        @foreach ($files as $file)
        <div class="bg-white shadow rounded-lg p-4">

            <div class="flex items-center gap-3 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                </svg>

                <div>
                    <p class="font-semibold">{{ $file->judul }}</p>
                    <p class="text-sm text-gray-500 capitalize">{{ $file->kategori }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('file.download', $file->id) }}"
                    class="text-blue-600 underline">Download</a>

                @if(Auth::user()->role == 'guru')
                <form 
                    action="{{ route('file.delete', $file->id) }}" 
                    method="POST"
                    onsubmit="return confirm('Hapus file ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                </form>
                @endif
            </div>

        </div>
        @endforeach

    </div>

    <div class="mt-4">
        {{ $files->links() }}
    </div>

</div>


{{-- MODAL UPLOAD --}}
<div id="modalUpload" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="text-xl font-semibold mb-3">Upload File</h2>

        <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input name="judul" placeholder="Judul file" class="border p-2 w-full mb-3" required>

            <select name="kategori" class="border p-2 w-full mb-3">
                <option value="materi">Materi</option>
                <option value="tugas">Tugas</option>
                <option value="umum">Umum</option>
            </select>

            <label>File</label>
            <input type="file" name="file" class="border p-2 w-full mb-4" required>

            <div class="flex justify-end gap-2">
                <button 
                    type="button"
                    onclick="document.getElementById('modalUpload').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">
                    Batal
                </button>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Upload
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
