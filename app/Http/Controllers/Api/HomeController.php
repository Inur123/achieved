<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Iklan;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        // Ambil 5 post terbaru yang dipublish untuk messages
        $messages = Post::where('is_published', 1)
            ->latest()
            ->take(5)
            ->pluck('title')
            ->toArray();

        // Ambil 2 iklan terbaru
        $iklan = Iklan::latest()->take(2)->get();

        // Ambil 3 video terbaru
        $vidio = Video::latest()->take(3)->get();

        // Return all data as a JSON response
        return response()->json([
            'post_terkini' => $post_terkini,
            'berita_terkini' => $berita_terkini,
            'opini_terkini' => $opini_terkini,
            'podcast_terkini' => $podcast_terkini,
            'post_populer' => $post_populer,
            'messages' => $messages,
            'iklan' => $iklan,
            'vidio' => $vidio,
        ]);
    }
}

