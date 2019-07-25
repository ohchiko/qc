<?php

namespace App\API\Controllers\V1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\API\Controllers\BaseController;

class APIAuthentication extends BaseController
{
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify credentials 
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'errors' => [
                        [
                            'status' => '401',
                            'title' => 'Invalid Credentials',
                            'detail' => 'User not found.',
                        ]
                    ]
                ], 401);
            }
        } catch (Exception $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'errors' => [
                    [
                        'status' => '500',
                        'title' => 'Internal Server Error',
                        'detail' => 'Cannot create a token.'
                    ]
                ]
            ], 500);
        }

        // all good so return the token
        $token = Auth::user()->api_token;

        return response()->json(compact('token'));
    }

    public function index()
    {
        return response()->json([
            'message' => 'You are authenticated.'
        ], 200);
    }
}

