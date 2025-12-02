<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('pages.siswa.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:students',
            'kelas' => 'required',
        ]);

        Student::create($request->all());

        return back()->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nis' => "required|unique:students,nis,$id",
            'kelas' => 'required',
        ]);

        $student->update($request->all());

        return back()->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
