<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::latest()->paginate(10);
        return view('pages.nilai.index', compact('scores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'mapel' => 'required',
            'nilai' => 'required|integer',
            'kelas' => 'required',
        ]);

        Score::create($request->all());
        return back()->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $score = Score::findOrFail($id);
        $score->update($request->all());

        return back()->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Score::findOrFail($id)->delete();
        return back()->with('success', 'Nilai berhasil dihapus.');
    }
}
