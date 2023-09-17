<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();


            if (!$user || $user->user_type !== 'admin') {
                return response()->json(['message' => 'Unauthorized!'], 403);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid Token!'], 401);
        }

        return $next($request);
    }
}