<?php

namespace App\Notifications\Channels;

use App\Notifications\Contracts\Notification;
use Illuminate\Support\Facades\Log;

class Push implements Notification
{
   public function send(string $message): void
   {
    Log::info('Push notification sent successfully', ['message' => $message]);
   }
}