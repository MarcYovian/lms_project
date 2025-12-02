<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;

        $query = UploadedFile::latest();

        // FILTER berdasarkan kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // siswa hanya boleh melihat materi + file miliknya
        if (Auth::user()->role == 'siswa') {
            $query->where(function ($q) {
                $q->where('kategori', 'materi')
                  ->orWhere('uploaded_by', Auth::id());
            });
        }

        $files = $query->paginate(12);

        return view('pages.upload.index', compact('files', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'file' => 'required|file|max:5000', // max 5MB
        ]);

        // SIMPAN FILE
        $path = $request->file('file')->store('uploads', 'public');

        // SIMPAN DATABASE
        $file = UploadedFile::create([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'file_path'  => $path,
            'uploaded_by'=> Auth::id(),
        ]);

        // ================================
        // 🔔 NOTIFIKASI otomatis ke siswa
        // ================================
        if ($request->kategori == 'materi') {
            foreach (User::where('role', 'siswa')->get() as $siswa) {
                Notification::create([
                    'user_id' => $siswa->id,
                    'judul'   => 'Materi baru tersedia!',
                    'pesan'   => $request->judul,
                ]);
            }
        }

        return back()->with('success', 'File berhasil diupload.');
    }

    public function download($id)
    {
        $file = UploadedFile::findOrFail($id);

        return Storage::disk('public')->download($file->file_path);
    }

    public function destroy($id)
    {
        $file = UploadedFile::findOrFail($id);

        Storage::disk('public')->delete($file->file_path);

        $file->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
