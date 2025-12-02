<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('pages.guru.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:teachers',
            'mapel' => 'required',
        ]);

        Teacher::create($request->all());
        return back()->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nip' => "required|unique:teachers,nip,$id",
            'mapel' => 'required',
        ]);

        $teacher->update($request->all());
        return back()->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return back()->with('success', 'Data guru berhasil dihapus.');
    }
}
