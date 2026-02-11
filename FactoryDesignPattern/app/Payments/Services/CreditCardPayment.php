<?php

namespace App\Payments\Services;

use App\Payments\Factories\PaymentFactory;
use App\Payments\Channels\CreditCard;
use App\Payments\Contracts\Payment;

class CreditCardPayment extends PaymentFactory
{
    protected function createPaymentObject(): Payment
    {
        return new CreditCard();
    }
}