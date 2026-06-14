<?php

namespace App\Enums;

enum SupportTicketTypes: string
{
    case ROBOT = 'robot';
    case CALL_CENTER = 'call_center';
    case TECHNICAL_SUPPORT = 'technical_support';
}