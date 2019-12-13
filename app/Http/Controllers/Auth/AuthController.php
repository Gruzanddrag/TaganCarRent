<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Exception;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login', 'registration']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $crd = request(['email', 'password']);
        if(!$token=auth()->attempt($crd)){
            return response()->json(['status' => false], 401);
        }
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration()
    {
        $params = request(['name', 'email', 'password', 'phone', 'app_to_drive']);
        $params['password'] = Hash::make($params['password']);
        try {
            $user = new User();
            $user->fill($params);
            $user->save();
            return response()->json(['status' => true]);
        } catch (Exception $exception){
            Log::error($exception);
            return response()->json(['status' => false]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => true]);

    }

}
