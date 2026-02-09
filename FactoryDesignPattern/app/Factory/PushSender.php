<?php

namespace App\Factory;

use App\Notifications\PushChannel;
use App\Notifications\NotificationChannel;

class PushSender extends NotificationSender
{
    public static function getNotificationChannel(string $type): NotificationChannel
    {
        if ($type !== NotificationSender::PUSH) {
            throw new \Exception('Invalid notification type: ' . $type);
        }
        return new PushChannel();
    }
}