<?php

namespace App\Providers;

use App\Models\Post;
use Spatie\Tags\Tag;
use App\Models\Iklan;
use App\Models\Video;
use Spatie\Health\Facades\Health;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
        ]);

        $post_populer = Post::where('is_published', 1)->orderBy('visits', 'desc')->take(5)->get();

        // Bagikan ke semua view
        View::share('post_populer', $post_populer);

        $iklan = Iklan::latest()->take(5)->get();

        // Bagikan ke semua view
        View::share([
            'post_populer' => $post_populer,
            'iklan' => $iklan, // Bagikan iklan ke semua view
        ]);

        $videos_terbaru = Video::latest()
        ->take(5)
        ->get(['id', 'title', 'url']);

    // Bagikan ke semua view
    View::share([
        'post_populer' => $post_populer,
        'iklan' => $iklan,
        'videos_terbaru' => $videos_terbaru, // Tambahkan video terbaru ke semua view
    ]);

    $usedTags = Tag::whereIn('id', function ($query) {
        $query->select('taggables.tag_id')
            ->from('taggables')
            ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
            ->where('taggables.taggable_type', Post::class) // Hanya tag dari Post
            ->where('posts.is_published', 1); // Hanya post yang is_published = 1
    })->get();

    // Bagikan data ke semua view
    View::share([
        'post_populer' => $post_populer,
        'iklan' => $iklan,
        'videos_terbaru' => $videos_terbaru,
        'usedTags' => $usedTags, // Tambahkan usedTags agar tersedia di semua view
    ]);
    }
}
