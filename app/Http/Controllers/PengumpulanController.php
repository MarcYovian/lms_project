<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\TugasPengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumpulanController extends Controller
{
    public function upload(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:5000'
        ]);

        $path = $request->file('file')->store('tugas', 'public');

        TugasPengumpulan::updateOrCreate(
            [
                'tugas_id' => $id,
                'siswa_id' => Auth::id()
            ],
            [
                'file_path' => $path
            ]
        );

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function nilai(Request $request, $id)
    {
        $pengumpulan = TugasPengumpulan::findOrFail($id);

        $pengumpulan->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Nilai berhasil disimpan!');
    }
}
