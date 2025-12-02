<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasPengumpulan extends Model
{
    protected $table = 'tugas_pengumpulan';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_path',
        'nilai',
        'catatan'
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
