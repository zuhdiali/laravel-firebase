<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return Response::json($request->user());
    }

    public function saveDeviceToken(Request $request)
    {
        $user = User::find(1);
        $user->device_token = $request->device_token;
        $user->save();
        return Response::json(['message' => 'Device token saved successfully']);
        // return response()->json(['message' => 'Device token saved successfully']);
    }
}
