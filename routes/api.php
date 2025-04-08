<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/save-device-token', [UserController::class, 'saveDeviceToken'])->name('save-device-token')->withoutMiddleware(['auth:sanctum']);
// Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send-notification')->withoutMiddleware(['auth:sanctum']);
