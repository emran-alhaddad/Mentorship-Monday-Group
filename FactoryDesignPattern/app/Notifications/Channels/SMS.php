<?php

namespace App\Notifications\Channels;

use App\Notifications\Contracts\Notification;
use Illuminate\Support\Facades\Log;

class SMS implements Notification
{
   public function send(string $message): void
   {
    Log::info('SMS notification sent successfully', ['message' => $message]);
   }
}