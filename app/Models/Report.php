<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Report extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'lampiran',
        'dibuat_oleh'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
