<?php

namespace App\Notifications;

use App\Notifications\NotificationTemplates\PushNotificationTemplate;

class PushChannel implements NotificationChannel
{
    public function authorizeChannel(): void
    {
        echo 'Authorizing push channel';
    }
    public function sendMessage(string $message): void
    {
        echo $this->getTemplate($message);
    }
    public function closeChannel(): void
    {
        echo 'Closing push channel';
    }
    public function getTemplate(string $message): string
    {
        return (new PushNotificationTemplate())->getTemplate($message);
    }
}
