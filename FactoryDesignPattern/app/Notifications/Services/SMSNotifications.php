<?php

namespace App\Notifications\Services;

use App\Notifications\Factories\NotificationFactroy;
use App\Notifications\Channels\SMS;
use App\Notifications\Contracts\Notification;

class SMSNotifications extends NotificationFactroy
{
    protected function createNotificationObject(): Notification
    {
        return new SMS();
    }
}
