<?php

namespace App\Payments\Contracts;

interface Payment
{
    public function pay(float $amount): void;
}