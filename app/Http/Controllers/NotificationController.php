<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Services\FirebaseService;
use App\Models\User;
use App\Traits\PushNotification;

class NotificationController extends Controller
{
    use PushNotification;
    public function sendPushNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
            'data' => 'nullable|array',
        ]);
        $device_token = User::find($request->user_id)->device_token;
        if (!$device_token) {
            return response()->json(['message' => 'Device token not found'], 404);
        }
        // return response()->json(['message' => 'Notification sent successfully']);
        $response = $this->sendNotification($device_token, $request->title, $request->body, $request->data);
        return response()->json(['success' => true, 'response' => $response, 'message' => 'Notification sent successfully']);
    }



    // protected $firebaseService;

    // public function __construct(FirebaseService $firebaseService)
    // {
    //     $this->firebaseService = $firebaseService;
    // }

    // public function sendNotification(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|integer',
    //         'title' => 'required|string',
    //         'body' => 'required|string',
    //         'data' => 'nullable|array',
    //     ]);
    //     $device_token = User::find($request->user_id)->device_token;
    //     if (!$device_token) {
    //         return response()->json(['message' => 'Device token not found'], 404);
    //     }
    //     // return response()->json(['message' => 'Notification sent successfully']);
    //     $this->firebaseService->sendNotification($device_token, $request->title, $request->body, $request->data);
    //     return response()->json(['message' => 'Notification sent successfully']);
    // }
}
