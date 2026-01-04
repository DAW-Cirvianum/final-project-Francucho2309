<?php

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\ShirtController;
use App\Http\Controllers\ShirtImageController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('leagues', LeagueController::class);

Route::resource('teams', TeamController::class);

Route::resource('shirts', ShirtController::class);
Route::delete('shirtsimages/{image}', [ShirtImageController::class, 'destroy'])->name('shirt-images.destroy');