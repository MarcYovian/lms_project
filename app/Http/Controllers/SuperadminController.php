<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\SppPayment;
use Illuminate\Support\Facades\DB;

class SuperadminController extends Controller
{
    public function index()
    {
        $total_siswa = User::where('role', 'siswa')->count();
        $total_guru = User::where('role', 'guru')->count();
        $total_orangtua = User::where('role', 'orang_tua')->count();

        $absensi_hari_ini = Attendance::whereDate('tanggal', now())->count();

        $nilai_rata = Grade::avg('nilai');

        $spp_lunas = SppPayment::where('status','lunas')->count();
        $spp_belum = SppPayment::where('status','belum_bayar')->count();

        return view('pages.superadmin.dashboard', compact(
            'total_siswa', 'total_guru', 'total_orangtua',
            'absensi_hari_ini', 'nilai_rata',
            'spp_lunas', 'spp_belum'
        ));
    }
}
