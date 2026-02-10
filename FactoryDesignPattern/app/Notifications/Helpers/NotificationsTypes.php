<?php

namespace App\Notifications\Helpers;

enum NotificationsTypes: string
{
    case WHATSAPP = 'whatsapp';
    case EMAIL = 'email';
    case SMS = 'sms';
    case PUSH = 'push';
}