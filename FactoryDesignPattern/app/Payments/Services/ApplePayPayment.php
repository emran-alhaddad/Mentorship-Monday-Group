<?php

namespace App\Payments\Services;

use App\Payments\Factories\PaymentFactory;
use App\Payments\Channels\ApplePay;
use App\Payments\Contracts\Payment;

class ApplePayPayment extends PaymentFactory
{
    protected function createPaymentObject(): Payment
    {
        return new ApplePay();
    }
}