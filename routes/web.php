<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DoctorBioController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Frontend
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
        Route::get('/services/{service}', [ServiceController::class, 'show'])
            ->where('service', '[a-z0-9\-]+')
            ->name('service');
        Route::view('/articles', 'frontend.articles')->name('articles');
        Route::get('/articles/{article}', [ArticleController::class, 'show'])
            ->where('article', '[a-z0-9\-]+')
            ->name('article');
        Route::view('/photos', 'frontend.photos')->name('photos');
        Route::view('/videos', 'frontend.videos')->name('videos');
        Route::view('/contact', 'frontend.contact')->name('contact');
        Route::view('/review', 'frontend.review')->name('review');
    });

// Backend
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);
    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
    Route::get('/bio', [DoctorBioController::class, 'edit'])
        ->middleware('auth')
        ->name('bio.edit');
});
