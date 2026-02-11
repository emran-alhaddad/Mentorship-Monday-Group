<?php

namespace App\Payments\Factories;

use App\Payments\Contracts\Payment;
use App\Payments\Channels\PayPal;
use App\Payments\Channels\ApplePay;

abstract class PaymentFactory
{
    abstract protected function createPaymentObject(): Payment;

    public function pay(float $amount): void
    {
        $paymentObject = $this->createPaymentObject();
        $paymentObject->pay($amount);
    }
}