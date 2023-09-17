<?php

namespace App\Services\Auth;
use Illuminate\Support\Facades\Auth;
use App\Exceptions;

class LoginService 
{
    /**
     * 
     * @throws Exception
     */
    public function execute(array $credentials): array
    {
        $token = Auth::attempt($credentials);
        if(!$token) {
            return ['message' => 'Unauthorized'];
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 1440,
            'user' => auth()->user(),
            'user_type' => auth()->user()->user_type,
        ];
    }
}