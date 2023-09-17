<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exceptions;


class AuthController extends Controller
{
    
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request) 
    {
         /**
     * 
     * @throws Exception
     */
    
            $credentials = $request->only('email',  'password');
            $auth = $this->loginService->execute($credentials);
            
            return response()->json($auth, 200);
        
    }

    public function register(StoreUserRequest $request) {
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "user_type" => $request->user_type
            ]);
    
            return response()->json([
                "message" => 'User Created Successfully',
                "user" => $user
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
