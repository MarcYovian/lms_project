<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Jadwal extends Model
{
    protected $fillable = [
        'mapel',
        'guru',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
