<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'kelas',
        'deadline',
        'guru_id'
    ];

    public function pengumpulan()
    {
        return $this->hasMany(TugasPengumpulan::class);
    }
}
