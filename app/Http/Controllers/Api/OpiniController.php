<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpiniController extends Controller
{
    public function index()
    {
        // Ambil opini yang dipublish dengan kategori 'Opini'
        $opini = Post::whereHas('category', function ($query) {
                $query->where('name', 'Opini');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        // Kembalikan data sebagai JSON
        return response()->json($opini);
    }

    public function show($slug)
    {
        // Ambil opini berdasarkan slug yang dipublish
        $opini = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

        // Tambah jumlah kunjungan
        $opini->increment('visits');

        // Kembalikan data opini sebagai JSON
        return response()->json($opini);
    }
}
