<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaporSemester extends Model
{
    protected $table = 'rapor_semester';

    protected $fillable = [
        'siswa_id',
        'semester',
        'mapel',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'catatan',
        'guru_id'
    ];
}
