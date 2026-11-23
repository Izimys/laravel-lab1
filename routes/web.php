<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\TrackVisit;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\BlogController;

Route::get(
    '/blog/admin',
    [BlogController::class, 'admin']
)->name('blog.admin');
Route::resource('blog', BlogController::class);

Route::get('/rooms/admin', [RoomController::class, 'admin'])->name('rooms.admin');

Route::resource('filters', FilterController::class)
    ->except(['show']);

Route::get(
    '/blog/{blog}/tags',
    [BlogController::class, 'tags']
)->name('blog.tags');
Route::post(
    '/blog/{blog}/tags',
    [BlogController::class, 'tagsStore']
)->name('blog.tags.store');

Route::resource('blog', BlogController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::resource(
    'rooms',
    RoomController::class
);

Route::resource(
    'country',
    CountryController::class
);

Route::get(
    '/say/{message?}',
    [SiteController::class, 'say']
)->name('site.say');

Route::get(
    '/entry',
    [SiteController::class, 'entry']
)->name('entry.form');
Route::post(
    '/entry',
    [SiteController::class, 'entryStore']
)->name('entry.store');

Route::view(
    '/about',
    'site.about'
)->name('site.about');
Route::view(
    '/contact',
    'site.contact'
)->name('site.contact');

Route::get(
    '/booking',
    [BookingController::class, 'showForm']
)->name('booking.form');

Route::post(
    '/booking',
    [BookingController::class, 'processForm']
)->name('booking.store');

Route::get(
    '/stats',
    [StatsController::class, 'pages']
)->name('stats.pages');

Route::get(
    '/stats/detail',
    [StatsController::class, 'detail']
)->name('stats.detail');
