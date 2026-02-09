<?php

namespace App\Notifications;

use App\Notifications\NotificationTemplates\SMSNotificationTemplate;

class SMSChannel implements NotificationChannel
{
    public function authorizeChannel(): void
    {
        echo 'Authorizing SMS channel';
    }
    public function sendMessage(string $message): void
    {
        echo $this->getTemplate($message);
    }
    public function closeChannel(): void
    {
        echo 'Closing SMS channel';
    }
    public function getTemplate(string $message): string
    {
        return (new SMSNotificationTemplate())->getTemplate($message);
    }
}
