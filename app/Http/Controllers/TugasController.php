<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'guru') {
            $tugas = Tugas::where('guru_id', Auth::id())->get();
        } else {
            $tugas = Tugas::where('kelas', Auth::user()->kelas)->get();
        }

        return view('pages.tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('pages.tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'deadline' => 'required|date',
        ]);

        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas' => $request->kelas,
            'deadline' => $request->deadline,
            'guru_id' => Auth::id(),
        ]);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dibuat!');
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('pages.tugas.detail', compact('tugas'));
    }
}
