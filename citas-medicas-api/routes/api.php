<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::apiResource('/appointments', AppointmentController::class);
});

/* Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('logout', [AuthController::class, 'logout']);
});*/
