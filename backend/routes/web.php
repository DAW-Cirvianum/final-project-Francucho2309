<?php

use App\Http\Controllers\ShirtController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shirts', ShirtController::class);
Route::resource('teams', TeamController::class);