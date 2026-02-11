<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Helpers\PaymentsTypes;
use App\Payments\Services\ApplePayPayment;
use App\Payments\Services\CreditCardPayment;
use App\Payments\Services\BankTransferPayment;

class PaymentsController extends Controller
{
    public function pay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:' . implode(',', array_column(PaymentsTypes::cases(), 'value')),
        ]); 
        
        $paymentService = match ($request->type) {
            PaymentsTypes::APPLE_PAY->value => new ApplePayPayment(),
            PaymentsTypes::CREDIT_CARD->value => new CreditCardPayment(),
            PaymentsTypes::BANK_TRANSFER->value => new BankTransferPayment(),
            default => throw new \Exception('Invalid payment type: ' . $request->type),
        };
        $paymentService->pay($request->amount);
        return response()->json(['message' => 'Payment successful via ' . $request->type]);
    }
}