<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users via REST API
    |
    */

    public function authenticate(ApiLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(!Auth::user()->hasRole($request->role)) {
                return response()->json(["error" => "Permission denied. No suitable role found"], 400);
            }
            $user = Auth::user();
            $token = $user->createToken('Default')->accessToken;
            return response()->json(["token" => $token, "user" => $user]);
        }
        return response()->json(["error" => "Invalid Login"], 400);
    }
}
