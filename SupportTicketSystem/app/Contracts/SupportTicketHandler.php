<?php

namespace App\Contracts;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SupportTicketHandler
{
    public function setNextHandler(SupportTicketHandler $handler);
    public function handle(Request $request): Response;
}