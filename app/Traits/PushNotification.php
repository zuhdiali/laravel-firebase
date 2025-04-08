<?php

namespace App\Traits;

use Exception;
use Google\Auth\ApplicationDefaultCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait PushNotification
{
    public function sendNotification($token, $title, $body, $data = [])
    {
        $fcmurl = "https://fcm.googleapis.com/v1/projects/percobaan-notif-lagi-456/messages:send";

        $notification = [
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data,
            'token' => $token,
            // 'sound' => true,
        ];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json',
            ])->post($fcmurl, [
                'message' => $notification,
            ]);
            return $response->json();
        } catch (Exception $e) {
            // Handle the exception as needed
            return response()->json(['error' => 'Failed to send notification: ' . $e->getMessage()], 500);
        }
    }

    private function getAccessToken()
    {
        $keyPath = storage_path('percobaan-notif-lagi-456-8d54a32bdc54.json');
        // $keyPath = config('services.firebase.key_path');

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $keyPath);

        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        $credential = ApplicationDefaultCredentials::getCredentials($scopes);

        $token = $credential->fetchAuthToken()['access_token'];
        return $token ?? null;


        // $url = 'https://oauth2.googleapis.com/token';
        // $client_id = env('FIREBASE_CLIENT_ID');
        // $client_secret = env('FIREBASE_CLIENT_SECRET');
        // $refresh_token = env('FIREBASE_REFRESH_TOKEN');

        // $response = Http::asForm()->post($url, [
        //     'client_id' => $client_id,
        //     'client_secret' => $client_secret,
        //     'refresh_token' => $refresh_token,
        //     'grant_type' => 'refresh_token',
        // ]);

        // return $response->json()['access_token'];
    }

    public function sendNotificationToDevice($device_token, $title, $body, $data = [])
    {
        $accessToken = $this->getAccessToken();
        return $this->sendNotification($device_token, $title, $body, $data);
    }
}
