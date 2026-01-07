<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LeagueController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ShirtController;
use App\Http\Controllers\Api\ShirtImageController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/leagues', [LeagueController::class, 'index']);
    Route::get('/leagues/{league}', [LeagueController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/leagues', [LeagueController::class, 'store']);
    Route::put('/leagues/{league}', [LeagueController::class, 'update']);
    Route::delete('/leagues/{league}', [LeagueController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{team}', [TeamController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/teams', [TeamController::class, 'store']);
    Route::put('/teams/{team}', [TeamController::class, 'update']);
    Route::delete('/teams/{team}', [TeamController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/shirts', [ShirtController::class, 'index']);
    Route::get('/shirts/{shirt}', [ShirtController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/shirts', [ShirtController::class, 'store']);
    Route::put('/shirts/{shirt}', [ShirtController::class, 'update']);
        Route::delete('/shirts/{shirt}', [ShirtController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/shirts/{shirt}/images', [ShirtImageController::class, 'store']);
    Route::delete('/shirt-images/{image}', [ShirtImageController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'show']);
    Route::post('/cart/items', [CartController::class, 'addItem']);
    Route::delete('/cart/items/{item}', [CartController::class, 'removeItem']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
});