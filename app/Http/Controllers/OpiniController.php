<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class OpiniController extends Controller
{

    public function index()
    {
        $opini = Post::whereHas('category', function ($query) {
                $query->where('name', 'Opini');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        return view('opini.index', compact('opini'));
    }

    public function show($slug)
    {
        $opini = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

        // Tambah jumlah kunjungan
        $opini->increment('visits');

        return view('opini.show', compact('opini'));
    }
}
