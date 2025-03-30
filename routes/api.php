<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('tickets')->group(function () {
        Route::post('/', [TicketController::class, 'store']);
        Route::get('/', [TicketController::class, 'index']);
        Route::get('/{ticket}', [TicketController::class, 'show']);
        Route::put('/{ticket}/status', [TicketController::class, 'updateStatus']);
        Route::get('/client', [TicketController::class, 'clientTickets']);
        Route::delete('/{ticket}', [TicketController::class, 'deleteTicket']);
        Route::post('/{ticket}/responses', [ResponseController::class, 'store']);
        Route::get('/{ticket}/responses', [ResponseController::class, 'index']);
    });
});
