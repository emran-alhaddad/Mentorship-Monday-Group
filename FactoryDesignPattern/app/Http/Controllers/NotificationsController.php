<?php

namespace App\Http\Controllers;

use App\Notifications\Services\WhatsappNotifications;
use App\Notifications\Services\EmailNotifications;
use App\Notifications\Services\SMSNotifications;
use App\Notifications\Services\PushNotifications;
use Illuminate\Http\Request;
use App\Notifications\Helpers\NotificationsTypes;

class NotificationsController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|in:' . implode(',', array_column(NotificationsTypes::cases(), 'value')),
        ]); 
        
        $notificationService = match ($request->type) {
            NotificationsTypes::WHATSAPP->value => new WhatsappNotifications(),
            NotificationsTypes::EMAIL->value => new EmailNotifications(),
            NotificationsTypes::SMS->value => new SMSNotifications(),
            NotificationsTypes::PUSH->value => new PushNotifications(),
            default => throw new \Exception('Invalid notification type: ' . $request->type),
        };
        $notificationService->sendNotification($request->message);
        return response()->json(['message' => 'Notification sent successfully via ' . $request->type]);
    }
}