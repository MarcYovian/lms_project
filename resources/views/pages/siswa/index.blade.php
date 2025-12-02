@extends('layouts.dashboard')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">Data Siswa</h1>

    {{-- BUTTON TAMBAH --}}
    <button 
        onclick="document.getElementById('modalAdd').classList.remove('hidden')"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg mb-4">
        + Tambah Siswa
    </button>

    {{-- TABLE --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <table class="min-w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">NIS</th>
                    <th class="p-3">Kelas</th>
                    <th class="p-3">Alamat</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $siswa)
                <tr class="border-b">
                    <td class="p-3">{{ $siswa->nama }}</td>
                    <td class="p-3">{{ $siswa->nis }}</td>
                    <td class="p-3">{{ $siswa->kelas }}</td>
                    <td class="p-3">{{ $siswa->alamat }}</td>
                    <td class="p-3 flex space-x-2">

                        {{-- EDIT BUTTON --}}
                        <button onclick="openEdit({{ $siswa }})"
                            class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>

                        {{-- DELETE BUTTON --}}
                        <form action="{{ route('siswa.delete', $siswa->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
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
        {{ $students->links() }}
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modalAdd" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">

        <h2 class="text-xl font-semibold mb-3">Tambah Siswa</h2>

        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf

            <input name="nama" class="w-full p-2 border rounded mb-3" placeholder="Nama">
            <input name="nis" class="w-full p-2 border rounded mb-3" placeholder="NIS">
            <input name="kelas" class="w-full p-2 border rounded mb-3" placeholder="Kelas">
            <input name="alamat" class="w-full p-2 border rounded mb-3" placeholder="Alamat">
            <input name="telepon" class="w-full p-2 border rounded mb-3" placeholder="Telepon">

            <div class="flex justify-end space-x-2">
                <button type="button"
                    onclick="document.getElementById('modalAdd').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>

        </form>

    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">

        <h2 class="text-xl font-semibold mb-3">Edit Siswa</h2>

        <form id="formEdit" method="POST">
            @csrf

            <input id="edit_nama" name="nama" class="w-full p-2 border rounded mb-3" placeholder="Nama">
            <input id="edit_nis" name="nis" class="w-full p-2 border rounded mb-3" placeholder="NIS">
            <input id="edit_kelas" name="kelas" class="w-full p-2 border rounded mb-3" placeholder="Kelas">
            <input id="edit_alamat" name="alamat" class="w-full p-2 border rounded mb-3" placeholder="Alamat">
            <input id="edit_telepon" name="telepon" class="w-full p-2 border rounded mb-3" placeholder="Telepon">

            <div class="flex justify-end space-x-2">
                <button type="button"
                    onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                <button class="px-4 py-2 bg-yellow-600 text-white rounded">Perbarui</button>
            </div>

        </form>

    </div>
</div>

<script>
function openEdit(data) {
    document.getElementById('modalEdit').classList.remove('hidden');

    document.getElementById('edit_nama').value = data.nama;
    document.getElementById('edit_nis').value = data.nis;
    document.getElementById('edit_kelas').value = data.kelas;
    document.getElementById('edit_alamat').value = data.alamat;
    document.getElementById('edit_telepon').value = data.telepon;

    document.getElementById('formEdit').action = '/data-siswa/' + data.id;
}
</script>

@endsection
