<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RaporSemester;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RaporPdfController extends Controller
{
    public function generate($siswa_id)
    {
        $siswa = User::findOrFail($siswa_id);
        $rapor = RaporSemester::where('siswa_id', $siswa_id)->get();

        $pdf = Pdf::loadView('pages.rapor.pdf', compact('siswa', 'rapor'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('Rapor_'.$siswa->name.'.pdf');
    }
}
