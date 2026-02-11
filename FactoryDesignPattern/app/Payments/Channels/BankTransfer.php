<?php

namespace App\Payments\Channels;

use App\Payments\Contracts\Payment;
use Illuminate\Support\Facades\Log;

class BankTransfer implements Payment
{
    public function pay(float $amount): void
    {
        Log::info('BankTransfer payment successful', ['amount' => $amount]);
    }
}