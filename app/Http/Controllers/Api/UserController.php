<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Exception;;

class UserController extends Controller
{

    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        try {
            $user = $this->user->all();
            if(count($user) > 0) {
                return response()->json($user, 200);
            }

            throw new \Exception("There are no registered users!", 404);
        } catch (\Exception $th) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }


    public function show(string $id)
    {
        try {
            $user = $this->user->find($id);
            return response()->json($user, 200);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }

    public function update(Request $request, string $id)
    {

        try {
            $validate = validator($request->all(), $this->user->rolesUserUpdate);
            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $user = $this->user->find($id);
            if($user) {
                $date = $request->all();
                $user->update($date);

                return response()->json($user, 201);
            }

            throw new \Exception("User Not Found!", 404);

        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
            ]);
        }

    }

  
    public function destroy(string $id)
    {
        try {
           $user = $this->user->find($id);
           if($user) {
            $user->delete();
            return response()->json("User Deleted Successfully!", 200);
           } else {
            throw new \Exception("User Not Found!", 404);
           }

        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
            ]);
        }
    }
}
