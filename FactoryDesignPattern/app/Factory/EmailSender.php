<?php

namespace App\Factory;

use App\Notifications\EmailChannel;
use App\Notifications\NotificationChannel;

class EmailSender extends NotificationSender
{
    public static function getNotificationChannel(string $type): NotificationChannel
    {
        if ($type !== NotificationSender::EMAIL) {
            throw new \Exception('Invalid notification type: ' . $type);
        }
        return new EmailChannel();
    }
}