<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // halaman rekap (guru & kepsek)
    public function index()
    {
        $absensi = Absensi::with('siswa')->latest()->paginate(20);
        return view('pages.absensi.index', compact('absensi'));
    }

    // form input absensi
    public function create()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('pages.absensi.create', compact('siswa'));
    }

    // simpan absensi
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
        ]);

        Absensi::create($request->all());

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil ditambahkan');
    }
}
