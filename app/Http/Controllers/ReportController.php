<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // 1️⃣ Guru melihat seluruh nilai siswa
    public function guruIndex()
    {
        $nilai = Nilai::with('siswa')->orderBy('created_at', 'desc')->get();

        return view('pages.laporan.guru', compact('nilai'));
    }

    // 2️⃣ Kepala Sekolah melihat rekap keseluruhan
    public function kepsekIndex()
    {
        $rekap = User::where('role', 'siswa')
            ->withAvg('nilai', 'nilai')
            ->withCount('nilai')
            ->get();

        return view('pages.laporan.kepsek', compact('rekap'));
    }

    // 3️⃣ Siswa melihat nilai dirinya
    public function siswaIndex()
    {
        $nilai = Nilai::where('siswa_id', Auth::id())->get();

        return view('pages.laporan.siswa', compact('nilai'));
    }
}
