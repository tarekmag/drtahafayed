<?php

use App\Http\Controllers\Backend\ArticleController as BackendArticleController;
use App\Http\Controllers\Backend\ClinicController;
use App\Http\Controllers\Backend\ContactDataController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DoctorBioController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\PhotoController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Backend\ServiceController as BackendServiceController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\PageViewDurationController;
use App\Http\Controllers\Frontend\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Frontend
Route::redirect('/', '/ar');

Route::post('/page-views/{pageView}/duration', PageViewDurationController::class)
    ->middleware('throttle:60,1')
    ->name('site.page-views.duration');

Route::prefix('{locale}')
    ->where(['locale' => 'ar|en'])
    ->middleware(['set-locale', 'record-page-view'])
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

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/bio', [DoctorBioController::class, 'edit'])->name('bio.edit');
    Route::get('/services', [BackendServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [BackendServiceController::class, 'create'])->name('services.create');
    Route::get('/services/{service}/edit', [BackendServiceController::class, 'edit'])->name('services.edit');
    Route::get('/articles', [BackendArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [BackendArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles/{article}/edit', [BackendArticleController::class, 'edit'])->name('articles.edit');
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::get('/clinics', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('/clinics/create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::get('/clinics/{clinic}/edit', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{patientReview}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{contact}', [MessageController::class, 'show'])->name('messages.show');
    Route::get('/contacts', [ContactDataController::class, 'edit'])->name('contacts.edit');
    Route::get('/social', [SocialMediaController::class, 'edit'])->name('social.edit');
    Route::get('/seo', [SeoController::class, 'edit'])->name('seo.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
});
