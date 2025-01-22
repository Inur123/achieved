<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Tentukan nama tabel jika tidak menggunakan penamaan konvensi Laravel
    protected $table = 'authors';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',
        'photo', // Foto penulis (path atau URL)
        'description', // Deskripsi singkat penulis
    ];

    // Jika Anda ingin menggunakan timestamp otomatis untuk created_at dan updated_at
    public $timestamps = true;

    /**
     * Relasi antara Author dan Post
     * Seorang author bisa memiliki banyak post.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
