<?php

namespace App\Notifications\Services;

use App\Notifications\Factories\NotificationFactroy;
use App\Notifications\Channels\Whatsapp;
use App\Notifications\Contracts\Notification;

class WhatsappNotifications extends NotificationFactroy
{
    protected function createNotificationObject(): Notification
    {
        return new Whatsapp();
    }
}
