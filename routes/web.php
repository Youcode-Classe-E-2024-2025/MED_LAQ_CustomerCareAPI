<?php

use Illuminate\Support\Facades\Route;

Route::get('/Login', function () {
    return inertia('Login');
});

Route::get('/Register', function () {
    return inertia('Register');
});
