<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ar');

Route::prefix('{locale}')
    ->where(['locale' => 'ar|en'])
    ->middleware('set-locale')
    ->name('site.')
    ->group(function () {
        Route::view('/', 'frontend.home')->name('home');
        Route::view('/about', 'frontend.about')->name('about');
        Route::view('/services', 'frontend.services')->name('services');
        Route::view('/clinics', 'frontend.clinics')->name('clinics');
        Route::get('/services/{service}', function () {
            $item = collect(config('medical_services.items'))->firstWhere('id', request()->route('service'));
            abort_unless($item, 404);

            return view('frontend.service', ['service' => $item]);
        })->where('service', '[a-z0-9\-]+')->name('service');
        Route::view('/articles', 'frontend.articles')->name('articles');
        Route::view('/articles/thyroid-overview', 'frontend.article')->name('article');
        Route::view('/photos', 'frontend.photos')->name('photos');
        Route::view('/videos', 'frontend.videos')->name('videos');
        Route::view('/contact', 'frontend.contact')->name('contact');
    });

// Backend
Route::prefix('backend')->group(function () {
    Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
});
