<?php

namespace App\Notifications\NotificationTemplates;

interface NotificationTemplate
{
    public function getTemplate(string $message): string;
    
}

