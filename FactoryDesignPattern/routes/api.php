<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/notify', [NotificationsController::class, 'sendNotification']);
Route::post('/pay', [PaymentsController::class, 'pay']);