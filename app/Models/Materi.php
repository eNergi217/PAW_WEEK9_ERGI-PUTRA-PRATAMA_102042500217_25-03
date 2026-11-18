<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'user_id'];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}