<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Inertia\Inertia;

Route::get('/Login', function () {
    return inertia('Login');
});

Route::get('/Register', function () {
    return inertia('Register');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return inertia('Dashboard');
})->middleware(['auth'])->name('dashboard');

