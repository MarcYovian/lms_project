<?php

namespace App\Http\Controllers;

use App\Models\RaporSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaporController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'guru') {
            $rapor = RaporSemester::where('guru_id', Auth::id())->get();
        } else {
            $rapor = RaporSemester::where('siswa_id', Auth::id())->get();
        }

        return view('pages.rapor.index', compact('rapor'));
    }

    public function create()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('pages.rapor.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'semester' => 'required',
            'mapel' => 'required',
            'nilai_tugas' => 'required|integer',
            'nilai_uts' => 'required|integer',
            'nilai_uas' => 'required|integer',
        ]);

        $akhir = ($request->nilai_tugas + $request->nilai_uts + $request->nilai_uas) / 3;

        RaporSemester::create([
            'siswa_id' => $request->siswa_id,
            'semester' => $request->semester,
            'mapel' => $request->mapel,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => floor($akhir),
            'catatan' => $request->catatan,
            'guru_id' => Auth::id()
        ]);

        return redirect()->route('rapor.index')->with('success', 'Nilai rapor disimpan!');
    }

    public function show($id)
    {
        $rapor = RaporSemester::where('siswa_id', $id)->get();
        $siswa = User::find($id);

        return view('pages.rapor.detail', compact('rapor', 'siswa'));
    }
}
