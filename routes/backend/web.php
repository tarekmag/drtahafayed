<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('backend')->group(function () {
    Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

    Route::get('/', [HomeController::class, 'index'])
        ->middleware('auth')
        ->name('home');
});
