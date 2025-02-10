<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PodcastController extends Controller
{

    public function index()
    {
        $podcast = Post::whereHas('category', function ($query) {
                $query->where('name', 'Podcast');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        return view('podcast.index', compact('podcast'));
    }

    public function show($slug)
    {
        $podcast = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

        // Tambah jumlah kunjungan
        $podcast->increment('visits');

        return view('podcast.show', compact('podcast'));
    }
}
