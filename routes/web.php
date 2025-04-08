<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/save-device-token', [UserController::class, 'saveDeviceToken'])->name('save-device-token');
Route::post('/send-push-notification', [NotificationController::class, 'sendPushNotification'])->name('send-push-notification');
