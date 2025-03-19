<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;

Route::post('/users', function (Request $request, UserService $userService) {
    return $userService->createUser($request->all());
});

Route::put('/users/{id}', function (Request $request, $user , UserService $userService) {
    return $userService->updateUser($user, $request->all());
});