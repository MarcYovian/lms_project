<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    protected $fillable = ['forum_id', 'user_id', 'pesan', 'lampiran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
