<?php

namespace App\Chains\SupportTicketChain;

use App\Contracts\SupportTicketHandler;

abstract class BaseSupportTicket implements SupportTicketHandler
{
    protected $nextHandler;

    public function setNextHandler(SupportTicketHandler $handler)
    {
        $this->nextHandler = $handler;
        return $this;
    }
}