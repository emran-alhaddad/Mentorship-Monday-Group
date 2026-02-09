<?php

namespace App\Notifications\NotificationTemplates;

class PushNotificationTemplate implements NotificationTemplate
{
    public function getTemplate(string $message): string
    {
        return 'Push Notification: ' . $message ;
    }
}