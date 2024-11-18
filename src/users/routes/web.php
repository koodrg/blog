<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\App\Http\Controllers\Auth\GoogleController;
use App\App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    phpinfo();
});

Route::get('/ping', function () {
    $connection = DB::connection('mongodb');
    $msg = 'MongoDB is accessible!';
    try {
        $connection->command(['ping' => 1]);
    } catch (\Exception $e) {
        $msg = 'MongoDB is not accessible. Error: ' . $e->getMessage();
    }
    return ['msg' => $msg];
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('login', [GoogleController::class, 'login'])->name('login');
Route::post('login', [GoogleController::class, 'singIn']);

Route::get('home', [HomeController::class, 'index']);
