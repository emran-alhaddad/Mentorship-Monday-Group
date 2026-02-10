<?php

namespace App\Notifications\Channels;

use App\Notifications\Contracts\Notification;
use Illuminate\Support\Facades\Log;

class Whatsapp implements Notification
{
   public function send(string $message): void
   {
    Log::info('Whatsapp notification sent successfully', ['message' => $message]);
   }
}