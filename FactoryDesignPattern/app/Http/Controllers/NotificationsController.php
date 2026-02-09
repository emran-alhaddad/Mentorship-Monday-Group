<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;
use App\Factory\NotificationSender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationsController extends Controller
{
    public function notifyUser(NotificationRequest $request)
    {
        try {
            $validated = $request->validated();

            DB::transaction(function () use ($validated) {

                if (Notifications::where('user_id', $validated['user_id'])->where('type', $validated['type'])->where('message', $validated['message'])->exists()) {
                    return response()->json([
                        'message' => 'Notification already sent to this user',
                    ], 200);
                }

                $notification = Notifications::create([
                    'user_id' => $validated['user_id'],
                    'type' => $validated['type'],
                    'message' => $validated['message'],
                    'unique_id' => $validated['type'] . '-notification:' . Str::uuid(),
                ]);

                $notificationSender = NotificationSender::getNotificationChannel($validated['type']);
                $notificationSender->sendMessage($validated['message']);
                $notification->update(['status' => 'sent']);
                return response()->json([
                    'message' => 'Notification sent successfully',
                ], 200);
            });
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'message' => 'Failed to send notification: ' . $th->getMessage(),
            ], 500);
        }
    }
}
