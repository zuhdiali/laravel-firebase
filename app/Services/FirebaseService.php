<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Cloud;

// require __DIR__ . '/../../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $serviceAccountPath = storage_path('percobaan-notif-lagi-456-8d54a32bdc54.json');

        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath);
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification($device_token, $title, $body, $data = [])
    {
        $message = CloudMessage::withTarget('token', $device_token)
            ->withNotification([
                'title' => $title,
                'body' => $body,
            ])
            ->withData($data);

        $this->messaging->send($message);
    }
}
