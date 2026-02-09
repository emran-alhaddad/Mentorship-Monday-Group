<?php

namespace App\Notifications;

use App\Notifications\NotificationTemplates\EmailNotificationTemplate;

class EmailChannel implements NotificationChannel
{
    public function authorizeChannel(): void
    {
        echo 'Authorizing email channel';
    }
    public function sendMessage(string $message): void
    {
        echo $this->getTemplate($message);
    }
    public function closeChannel(): void
    {
        echo 'Closing email channel';
    }
    public function getTemplate(string $message): string
    {
        return (new EmailNotificationTemplate())->getTemplate($message);
    }
}