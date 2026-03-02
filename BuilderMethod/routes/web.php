<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/simple', [ProductsController::class, 'buildSimpleDemoProduct']);
Route::get('/products/advanced', [ProductsController::class, 'buildAdvancedDemoProduct']);