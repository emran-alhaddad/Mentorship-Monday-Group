<?php

namespace App\Notifications\Contracts;

interface Notification
{
    public function send(string $message): void;
}