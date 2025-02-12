<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil berita yang dipublish dengan kategori 'Berita'
        $berita = Post::whereHas('category', function ($query) {
                $query->where('name', 'Berita');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        // Kembalikan data sebagai JSON
        return response()->json($berita);
    }

    public function show($slug)
    {
        // Ambil berita berdasarkan slug yang dipublish
        $berita = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

        // Tambah jumlah kunjungan
        $berita->increment('visits');

        // Kembalikan data berita sebagai JSON
        return response()->json($berita);
    }
}
