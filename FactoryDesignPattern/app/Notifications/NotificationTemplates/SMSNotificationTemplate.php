<?php

namespace App\Notifications\NotificationTemplates;

class SMSNotificationTemplate implements NotificationTemplate
{
    public function getTemplate(string $message): string
    {
        return 'SMS Notification: ' . $message ;
    }
}