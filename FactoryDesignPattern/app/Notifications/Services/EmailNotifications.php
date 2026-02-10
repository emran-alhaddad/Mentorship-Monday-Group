<?php

namespace App\Notifications\Services;

use App\Notifications\Factories\NotificationFactroy;
use App\Notifications\Channels\Email;
use App\Notifications\Contracts\Notification;

class EmailNotifications extends NotificationFactroy
{
    protected function createNotificationObject(): Notification
    {
        return new Email();
    }
}
