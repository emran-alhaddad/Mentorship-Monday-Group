<?php

namespace App\Payments\Services;

use App\Payments\Factories\PaymentFactory;
use App\Payments\Channels\BankTransfer;
use App\Payments\Contracts\Payment;

class BankTransferPayment extends PaymentFactory
{
    protected function createPaymentObject(): Payment
    {
        return new BankTransfer();
    }
}