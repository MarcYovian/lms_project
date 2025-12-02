<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    // Guru: Lihat daftar nilai yg dia input
    public function index()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403);
        }

        $nilai = Nilai::where('guru_id', Auth::id())->get();

        return view('pages.nilai.index', compact('nilai'));
    }

    // Guru: Form input nilai
    public function create()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403);
        }

        $siswa = User::where('role', 'siswa')->get();

        return view('pages.nilai.create', compact('siswa'));
    }

    // Guru: Simpan nilai
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'mapel' => 'required',
            'nilai' => 'required|integer|min:0|max:100',
            'keterangan' => 'nullable',
        ]);

        Nilai::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => Auth::id(),
            'mapel' => $request->mapel,
            'nilai' => $request->nilai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    // Siswa: melihat nilai miliknya
    public function siswaNilai()
    {
        if (Auth::user()->role !== 'siswa') {
            abort(403);
        }

        $nilai = Nilai::where('siswa_id', Auth::id())->get();

        return view('pages.nilai.siswa', compact('nilai'));
    }
}
