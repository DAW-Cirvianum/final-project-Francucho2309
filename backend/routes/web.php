<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShirtController;
use App\Http\Controllers\Admin\ShirtImageController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('leagues', LeagueController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('shirts', ShirtController::class);

    Route::post('shirts/{shirt}/images', [ShirtImageController::class, 'store'])->name('shirts.images.store');
    Route::delete('shirts/images/{image}', [ShirtImageController::class, 'destroy'])->name('shirts.images.destroy');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';
