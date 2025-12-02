<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = [
        'judul', 'isi', 'lampiran', 'publish_at', 'created_by', 'is_published'
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
