<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SpecialtiesRequest;
use App\Models\Specialties;
use Exception;

class SpecialtiesController extends Controller
{

    private $specialties;
    
    public function __construct(Specialties $specialties)
    {
        $this->specialties = $specialties;
    }


    
    public function index()
    {
        try {
            $specialties = $this->specialties->all();
            return response()->json($specialties, 200);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
        
    }


   
    public function store(SpecialtiesRequest $request)
    {
        try {
            $validate = validator($request->all(), $this->specialties->rules);
            if($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            } 
            $specialties = $this->specialties->create([
                "specialties_type" => $request->specialties_type
            ]);
            return response()->json([
                "specialties_type" => $specialties,
                "message" => 'Specialties Created Successfully'
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
            $specialties = $this->specialties->find($id);
            return response()->json($specialties, 200);
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
            $validate = validator($request->all(), $this->specialties->rules);
            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $specialties = $this->specialties->find($id);
            if($specialties) {
                $date = $request->all();
                $specialties->update($date);

                return response()->json($specialties, 201);
            }
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
            $specialties = $this->specialties->find($id);
           if($specialties) {
            $specialties->delete();
            return response()->json("Specialties Deleted Successfully!", 200);
           }
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }
}
