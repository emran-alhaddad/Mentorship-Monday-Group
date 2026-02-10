<?php

namespace App\Notifications\Factories;

use App\Notifications\Contracts\Notification;
use Illuminate\Support\Facades\Log;

abstract class NotificationFactroy
{
    abstract protected function createNotificationObject(): Notification;

    public function sendNotification(string $message): void
    {
        try {
            $notificationObject = $this->createNotificationObject();
            $notificationObject->send($message);
            Log::info('Notification sent successfully', ['message' => $message]);
        } catch (\Exception $e) {
            Log::error('Failed to send notification', ['error' => $e->getMessage()]);
        }
    }
}