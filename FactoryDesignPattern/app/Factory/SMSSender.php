<?php

namespace App\Factory;

use App\Notifications\SMSChannel;
use App\Notifications\NotificationChannel;

class SMSSender extends NotificationSender
{
    public static function getNotificationChannel(string $type): NotificationChannel
    {
        if ($type !== NotificationSender::SMS) {
            throw new \Exception('Invalid notification type: ' . $type);
        }
        return new SMSChannel();
    }
}