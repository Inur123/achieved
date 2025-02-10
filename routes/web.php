<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpiniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PodcastController;
use App\Http\Middleware\PreventRequestsDuringMaintenance;

Route::get('/', [HomeController::class, 'index']);

Route::middleware([PreventRequestsDuringMaintenance::class])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});


Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');




Route::get('/opini', [OpiniController::class, 'index'])->name('opini.index');
Route::get('/opini/{slug}', [OpiniController::class, 'show'])->name('opini.show');


Route::get('/podcast', [PodcastController::class, 'index'])->name('podcast.index');
Route::get('/podcast/{slug}', [PodcastController::class, 'show'])->name('podcast.show');
