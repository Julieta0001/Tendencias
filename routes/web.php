<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TravelerController;
use App\Http\Controllers\DestinationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/travelers/{traveler}/inscribir', [App\Http\Controllers\TravelerController::class, 'inscribirDestino'])->name('travelers.inscribir');

    Route::post('destinations/{destination}/inscribir', [DestinationController::class, 'inscribir'])
        ->name('destinations.inscribir');

    Route::resource('travelers', TravelerController::class);
    Route::resource('destinations', DestinationController::class);
});