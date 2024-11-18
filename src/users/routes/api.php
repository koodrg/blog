<?php

use App\App\Api\Controllers\AuthController;
use App\App\Api\Controllers\CommentController;
use App\App\Api\Controllers\PostController;
use App\App\Api\Controllers\UserController;
use App\App\Api\Controllers\UserNotificationController;
use App\App\Api\Middlewares\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'delete']);
        Route::get('/', [UserController::class, 'show']);

        Route::put('/notification-settings', [UserNotificationController::class, 'update']);
    });
});


