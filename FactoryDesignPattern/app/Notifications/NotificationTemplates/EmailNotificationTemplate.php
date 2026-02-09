<?php

namespace App\Notifications\NotificationTemplates;

class EmailNotificationTemplate implements NotificationTemplate
{
    public function getTemplate(string $message): string
    {
        return '
        <html>
        <head>
        <title>Email Notification</title>
        </head>
        <body>
        <h1>Email Notification</h1>
        <p>' . $message . '</p>
        </body>
        </html>
        ';
    }
}