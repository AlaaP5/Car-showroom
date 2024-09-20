<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use App\Models\Notification as ModelsNotification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class SendNotificationListener
{
    /**
     * Create the event listener.
     */

    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SendNotificationEvent $event): void
    {
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('laaast-10d01-firebase-adminsdk-yjop4-3d4fb752e8.json'));
        $messaging = $firebase->createMessaging();
        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'Books Kingdom',
                'body' => $event->body,
            ],
            'token' => $event->user->fcm_token,
        ]);
        $messaging->send($message);

        ModelsNotification::create(
            [
                'sender_id' => 1,
                'receiver_id' => $event->user->id,
                'title' => 'Books Kingdom',
                'text' => $event->body
            ]
        );

    }
}
