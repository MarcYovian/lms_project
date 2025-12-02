<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UploadedFile extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'judul',
        'kategori',
        'file_path',
        'uploaded_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
