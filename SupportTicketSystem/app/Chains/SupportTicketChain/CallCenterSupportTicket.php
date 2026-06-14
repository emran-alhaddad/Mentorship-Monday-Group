<?php

namespace App\Chains\SupportTicketChain;

use App\Contracts\SupportTicketHandler;
use App\Enums\SupportTicketTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CallCenterSupportTicket extends BaseSupportTicket
{
    public function handle(Request $request): Response
    {
        if ($request->get('type') === SupportTicketTypes::CALL_CENTER->value) {
            return response()->json([
                'message' => 'Call center support ticket handled',
            ], Response::HTTP_OK);
        }

        return $this->nextHandler->handle($request);
    }
}