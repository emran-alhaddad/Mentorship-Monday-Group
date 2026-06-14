<?php

use App\Http\Controllers\SupportTicketController;
use Illuminate\Support\Facades\Route;

Route::post('/submit-ticket', [SupportTicketController::class, 'handle']);
