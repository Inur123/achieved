<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventRequestsDuringMaintenance;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([PreventRequestsDuringMaintenance::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
