<?php

namespace App\Factory;

use App\Notifications\NotificationChannel;
use App\Notifications\EmailChannel;
use App\Notifications\SMSChannel;
use App\Notifications\PushChannel;

abstract class NotificationSender
{

     public const EMAIL = 'email';
     public const SMS = 'sms';
     public const PUSH = 'push';

     private static array $channels = [
        self::EMAIL =>  EmailChannel::class,
        self::SMS => SMSChannel::class,
        self::PUSH => PushChannel::class,
    ];
    public static function getTypes(): array
    {
        return array_keys(self::$channels);
    }

    public static function getNotificationChannel(string $type): NotificationChannel
    {
        return new self::$channels[$type]();
    }

    public function sendNotification(string $type, string $message): void
    {
        $notificationChannel = $this->getNotificationChannel($type);
        try {
            $notificationChannel->authorizeChannel();
            $notificationChannel->sendMessage($message);
            $notificationChannel->closeChannel();
        } catch (\Exception $e) {
            throw new \Exception('Failed to send notification: ' . $e->getMessage());
        }
    }
}
