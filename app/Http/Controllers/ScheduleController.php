<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->paginate(10);
        return view('pages.jadwal.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Schedule::create($request->all());
        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update($request->all());
        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
