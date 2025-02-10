<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'title',
        'url', // Foto penulis (path atau URL)
    ];
}
