<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BookingController;

Route::get(
    '/say/{message?}',
    [SiteController::class, 'say']
)->name('site.say');

Route::get('/', function () {
    return view('welcome');
});

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
