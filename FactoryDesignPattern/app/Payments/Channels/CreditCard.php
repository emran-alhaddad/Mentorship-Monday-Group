<?php

namespace App\Payments\Channels;

use App\Payments\Contracts\Payment;
use Illuminate\Support\Facades\Log;

class CreditCard implements Payment
{
    public function pay(float $amount): void
    {
        Log::info('CreditCard payment successful', ['amount' => $amount]);
    }
}