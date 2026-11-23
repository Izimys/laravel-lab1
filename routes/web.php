<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\TrackVisit;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('country', CountryController::class)->only(['index', 'show']);

Route::get('/say/{message?}', [SiteController::class, 'say'])->name('site.say');
Route::get('/entry', [SiteController::class, 'entry'])->name('entry.form');
Route::post('/entry', [SiteController::class, 'entryStore'])->name('entry.store');

Route::view('/about', 'site.about')->name('site.about');
Route::view('/contact', 'site.contact')->name('site.contact');

Route::get('/booking', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'processForm'])->name('booking.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/{blog}/tags', [BlogController::class, 'tags'])->name('blog.tags');
    Route::post('/blog/{blog}/tags', [BlogController::class, 'tagsStore'])->name('blog.tags.store');
    Route::resource('blog', BlogController::class)->except(['index', 'show']);

    Route::get('/rooms/admin', [RoomController::class, 'admin'])->name('rooms.admin');
    Route::resource('rooms', RoomController::class)->except(['index', 'show']);

    Route::resource('country', CountryController::class)->except(['index', 'show']);
    Route::resource('filters', FilterController::class)->except(['show']);

    Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
    Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
});

Route::resource('blog', BlogController::class)->only(['index', 'show']);
Route::resource('rooms', RoomController::class)->only(['index', 'show']);

require __DIR__ . '/auth.php';
