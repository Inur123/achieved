<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OpiniController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PodcastController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/home', HomeController::class);


Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);


Route::get('/podcast', [PodcastController::class, 'index']);
Route::get('/podcast/{slug}', [PodcastController::class, 'show']);


Route::get('/opini', [OpiniController::class, 'index']);
Route::get('/opini/{slug}', [OpiniController::class, 'show']);

