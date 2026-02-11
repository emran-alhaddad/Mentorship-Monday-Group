<?php

namespace App\Notifications\Helpers;

enum PaymentsTypes: string
{
    case APPLE_PAY = 'apple_pay';
    case CREDIT_CARD = 'credit_card';
    case BANK_TRANSFER = 'bank_transfer';
}