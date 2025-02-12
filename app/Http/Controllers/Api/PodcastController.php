<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PodcastController extends Controller
{
    public function index()
    {
        // Ambil podcast yang dipublish dengan kategori 'Podcast'
        $podcast = Post::whereHas('category', function ($query) {
                $query->where('name', 'Podcast');
            })
            ->where('is_published', 1) // Hanya ambil yang is_published = 1
            ->latest()
            ->get();

        // Kembalikan data sebagai JSON
        return response()->json($podcast);
    }

    public function show($slug)
    {
        // Ambil podcast berdasarkan slug yang dipublish
        $podcast = Post::where('slug', $slug)->where('is_published', 1)->firstOrFail();

        // Tambah jumlah kunjungan
        $podcast->increment('visits');

        // Kembalikan data podcast sebagai JSON
        return response()->json($podcast);
    }
}
