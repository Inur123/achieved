<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Post::whereHas('category', function ($query) {
                $query->where('name', 'Berita');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        return view('berita.index', compact('berita'));
    }


    public function show($slug)
{
    $berita = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

    // Tambah jumlah kunjungan
    $berita->increment('visits');

    return view('berita.show', compact('berita'));
}

}
