<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ResponseController;
use App\Models\Response;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('response', ResponseController::class);
    Route::get('tickets/{id}/responses', [ResponseController::class, 'getTicketResponses']);
});