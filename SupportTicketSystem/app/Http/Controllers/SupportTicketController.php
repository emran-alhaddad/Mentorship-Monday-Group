<?php

namespace App\Http\Controllers;

use App\Chains\SupportTicketChain\CallCenterSupportTicket;
use App\Chains\SupportTicketChain\RobotSupportTicket;
use App\Chains\SupportTicketChain\TechnicalSupportTicket;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportTicketController extends Controller
{
    public function handle(Request $request): Response
    {
        $robotSupportTicket = new RobotSupportTicket();
        $callCenterSupportTicket = new CallCenterSupportTicket();
        $technicalSupportTicket = new TechnicalSupportTicket();

        $robotSupportTicket->setNextHandler($callCenterSupportTicket);
        $callCenterSupportTicket->setNextHandler($technicalSupportTicket);

        return $robotSupportTicket->handle($request);
    }
}
