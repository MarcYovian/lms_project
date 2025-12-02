<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Task;
use App\Models\SppPayment;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    public function dashboard()
    {
        // ambil semua anak dari akun ini
        $anak = User::where('parent_id', Auth::id())->get();

        return view('pages.parent.dashboard', compact('anak'));
    }

    public function detail($id)
    {
        $siswa = User::findOrFail($id);

        $absensi = Attendance::where('siswa_id', $id)->latest()->get();
        $nilai = Grade::where('siswa_id', $id)->latest()->get();
        $tugas = Task::where('siswa_id', $id)->latest()->get();
        $spp = SppPayment::where('siswa_id', $id)->latest()->get();

        return view('pages.parent.detail', compact('siswa', 'absensi', 'nilai', 'tugas', 'spp'));
    }
}
