<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/Login', function () {
    return inertia('Login');
});

Route::get('/Register', function () {
    return inertia('Register');
});


Route::post('/Login', [AuthController::class, 'Login']);
Route::post('/Register', [AuthController::class, 'Register']);
