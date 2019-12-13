<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CheckJwtToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)//посредник, который обновляет токен, если тот истек
    {
        \Log::debug($request->headers->all());
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'status' => true,
                    'access_token' => auth()->refresh()
                ]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => false, 'msg' => 'invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                return response()->json(['status' => false]);
            } else {
                return response()->json(['status' => false, 'msg' => 'missing']);
            }
        } catch (TokenBlacklistedException $e) {
            return response()->json(['status' => false]);
        }

        return $next($request);
    }
}
