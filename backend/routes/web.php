<?php

use App\Http\Controllers\ShirtController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shirts', ShirtController::class);