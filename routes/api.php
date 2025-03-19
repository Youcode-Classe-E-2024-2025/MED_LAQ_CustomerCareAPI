<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;

Route::post('/users', function (Request $request, UserService $userService) {
    return $userService->createUser($request->all());
});