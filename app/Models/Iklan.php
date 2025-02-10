<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    protected $table = 'iklans';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',
        'image', // Foto penulis (path atau URL)
    ];
}
