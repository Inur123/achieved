<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Spatie\Tags\Tag;
use App\Models\Iklan;
use App\Models\Video;


class HomeController extends Controller
{
    public function index()
{
    // Ambil 2 post terbaru yang dipublish
    $post_terkini = Post::where('is_published', 1)->latest()->take(2)->get();

    // Ambil 2 berita terbaru dengan kategori 'Berita' dan status published
    $berita_terkini = Post::whereHas('category', function ($query) {
        $query->where('name', 'Berita');
    })->where('is_published', 1)->latest()->take(2)->get();

    // Ambil 2 opini terbaru dengan kategori 'Opini' dan status published
    $opini_terkini = Post::whereHas('category', function ($query) {
        $query->where('name', 'Opini');
    })->where('is_published', 1)->latest()->take(2)->get();

    // Ambil 2 podcast terbaru dengan kategori 'Podcast' dan status published
    $podcast_terkini = Post::whereHas('category', function ($query) {
        $query->where('name', 'Podcast');
    })->where('is_published', 1)->latest()->take(2)->get();

     // Ambil 5 post dengan jumlah visits terbanyak dan is_published = 1
     $post_populer = Post::where('is_published', 1)
        ->orderBy('visits', 'desc') // Urut berdasarkan visits terbanyak
        ->take(5)
        ->get();

        $messages = Post::where('is_published', 1)
                ->latest()
                ->take(5)
                ->pluck('title')
                ->toArray();

    $iklan = Iklan::latest()->take(2)->get();

    $vidio = Video::latest()->take(3)->get();

    $usedTags = Post::getUsedTags();

    return view('welcome', compact('post_terkini', 'berita_terkini', 'opini_terkini', 'podcast_terkini','post_populer','usedTags','messages','iklan'));
}

}
