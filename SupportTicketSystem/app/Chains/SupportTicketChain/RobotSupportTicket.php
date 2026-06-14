<?php

namespace App\Chains\SupportTicketChain;

use App\Contracts\SupportTicketHandler;
use App\Enums\SupportTicketTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RobotSupportTicket extends BaseSupportTicket
{

    public function handle(Request $request): Response
    {
        if ($request->get('type') === SupportTicketTypes::ROBOT->value) {
            return response()->json([
                'message' => 'Robot support ticket handled',
            ], Response::HTTP_OK);
        }

        return $this->nextHandler->handle($request);
    }
}