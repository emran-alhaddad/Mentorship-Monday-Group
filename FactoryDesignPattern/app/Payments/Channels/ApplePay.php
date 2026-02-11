<?php

namespace App\Payments\Channels;

use App\Payments\Contracts\Payment;
use Illuminate\Support\Facades\Log;

class ApplePay implements Payment
{
    public function pay(float $amount): void
    {
        Log::info('ApplePay payment successful', ['amount' => $amount]);
    }
}