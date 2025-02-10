<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Iklan;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori', Cache::remember('total_categories', 60, fn() => Category::count()))
                ->description('Jumlah kategori yang ada')
                ->color('primary'),

            Stat::make('Total Post', Cache::remember('total_posts', 60, fn() => Post::count()))
                ->description('Jumlah postingan yang ada')
                ->color('success'),

            Stat::make('Total Visits', Cache::remember('total_visits', 60, fn() => Post::sum('visits')))
                ->description('Jumlah total kunjungan semua postingan')
                ->color('warning'),

            Stat::make('Total Iklan', Cache::remember('total_ads', 60, fn() => Iklan::count()))
                ->description('Jumlah iklan yang ada')
                ->color('info'),


        ];
    }
}
