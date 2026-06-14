<?php

namespace App\Chains\SupportTicketChain;

use App\Contracts\SupportTicketHandler;
use App\Enums\SupportTicketTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TechnicalSupportTicket extends BaseSupportTicket
{
    public function handle(Request $request): Response
    {
        if ($request->get('type') === SupportTicketTypes::TECHNICAL_SUPPORT->value) {
            return response()->json([
                'message' => 'Technical support ticket handled',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Unsupported ticket type',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}