<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'mapel',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];
}
