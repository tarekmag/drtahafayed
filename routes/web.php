<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Frontend
Route::get('/', function () {
    return view('welcome');
});

//Backend
Route::prefix('backend')->group(function () {
    //Auth
    Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
});
