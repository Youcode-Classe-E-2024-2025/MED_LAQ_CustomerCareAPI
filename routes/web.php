<?php

use Illuminate\Support\Facades\Route;

Route::get('/Login', function () {
    return inertia('Login');
});

Route::get('/register', function () {
    return inertia('register');
});
