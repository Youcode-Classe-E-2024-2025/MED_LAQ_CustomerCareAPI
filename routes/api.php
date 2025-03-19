<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;

Route::post('/users', function (Request $request, UserService $userService) {
    return $userService->createUser($request->all());
});

Route::put('/users/{id}', function (Request $request, $id, UserService $userService) {
    return $userService->updateUser($id, $request->all());
});

Route::delete('/users/{id}', function ($id, UserService $userService) {
    return $userService->deleteUser($id);
});