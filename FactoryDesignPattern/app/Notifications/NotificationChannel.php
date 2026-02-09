<?php

namespace App\Notifications;

interface NotificationChannel
{
    public function authorizeChannel(): void;
    public function sendMessage(string $message): void;
    public function closeChannel(): void;
    public function getTemplate(string $message): string;
}