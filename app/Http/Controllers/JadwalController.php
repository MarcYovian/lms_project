<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'siswa') {
            $kelasUser = Auth::user()->kelas; 
            $jadwals = Jadwal::where('kelas', $kelasUser)->get();
        } 
        else {
            $jadwals = Jadwal::all();
        }

        return view('pages.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('pages.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'guru' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return back()->with('success', 'Jadwal dihapus.');
    }
}

