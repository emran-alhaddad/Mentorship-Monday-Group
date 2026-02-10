<?php

namespace App\Notifications\Channels;

use App\Notifications\Contracts\Notification;
use Illuminate\Support\Facades\Log;

class Email implements Notification
{
   public function send(string $message): void
   {
    Log::info('Email notification sent successfully', ['message' => $message]);
   }
}