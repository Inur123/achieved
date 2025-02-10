<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Iklan;
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
    }
}
