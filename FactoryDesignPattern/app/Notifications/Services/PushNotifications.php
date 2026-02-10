<?php

namespace App\Notifications\Services;

use App\Notifications\Factories\NotificationFactroy;
use App\Notifications\Channels\Push;
use App\Notifications\Contracts\Notification;

class PushNotifications extends NotificationFactroy
{
    protected function createNotificationObject(): Notification
    {
        return new Push();
    }
}
