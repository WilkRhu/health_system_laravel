<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtAdminAndUserMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized!'], 401);
            }

            if ($user->user_type === 'admin' || $user->id === $request->route('user')) {
                return $next($request); 
            }

            return response()->json(['message' => 'Unauthorized!'], 403);
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid Token!'], 401);
        }

        return $next($request);
    }
}