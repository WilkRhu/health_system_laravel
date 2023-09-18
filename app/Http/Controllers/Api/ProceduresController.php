<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedures;

class ProceduresController extends Controller
{
    private $procedures;

    public function __construct(Procedures $procedures) {
        $this->procedures = $procedures;
    }

    public function index()
    {
        try {
            $procedures = $this->procedures->all();
            return response()->json($procedures, 200);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }


   
    public function store(Request $request)
    {
        try {
            $validate = validator($request->all(), $this->procedures->rules);
            if($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            } 
            $procedures = $this->procedures->create([
                "procedure_name" => $request->procedure_name,
                "procedure_value" => $request->procedure_value
            ]);
            return response()->json([
                "procedure" => $procedures,
                "message" => 'Procedures Created Successfully'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }

   
    public function show(string $id)
    {
        try {
            $procedures = $this->procedures->find($id);
            return response()->json($procedures, 200);
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
            $procedures = $this->procedures->find($id);
            if($procedures) {
             $procedures->delete();
             return response()->json("Procedure Deleted Successfully!", 200);
            }
         } catch (\Exception $ex) {
             return response()->json([
                 'error_message' => $ex->getMessage(),
                 'status' => $ex->getCode()
             ]);
         }
    }
}
