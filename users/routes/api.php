<?php

use App\App\Api\Controllers\AuthController;
use App\App\Api\Controllers\CommentController;
use App\App\Api\Controllers\PostController;
use App\App\Api\Controllers\UserController;
use App\App\Api\Middlewares\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::prefix('users')->group(function () {
        Route::put('/profile', [UserController::class, 'update']);
        Route::delete('/profile', [UserController::class, 'delete']);
        Route::get('/profile', [UserController::class, 'show']);
    });

    Route::prefix('posts')->group(function () {
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{id}', [PostController::class, 'update']);
        Route::delete('/{id}', [PostController::class, 'destroy']);
    });

    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

Route::get('posts/{id}/comments', [CommentController::class, 'index']);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);



