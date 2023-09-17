<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthInsurance;

class HealthInsuranceController extends Controller
{

    private $healthInsurance;
  
    
    public function __construct(HealthInsurance $healthInsurance)
    {
        $this->healthInsurance = $healthInsurance;
    }

  
    public function index()
    {
        try {
            $healthInsurance = $this->healthInsurance->all();
            return response()->json($healthInsurance, 200);
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
            $validate = validator($request->all(), $this->healthInsurance->rules);
            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $healthInsurance = $this->healthInsurance->create([
                "description" => $request->description,
                "phone" => $request->phone
            ]);
            return response()->json([
                "specialties_type" => $healthInsurance,
                "message" => 'Health Insurance Created Successfully'
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
            $healthInsurance = $this->healthInsurance->find($id);
            return response()->json($healthInsurance, 200);
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
            $validate = validator($request->all(), $this->healthInsurance->rulesUpdate);
            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $healthInsurance = $this->healthInsurance->find($id);
            if($healthInsurance) {
                $date = $request->all();
                $healthInsurance->update($date);

                return response()->json($healthInsurance, 201);
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
            $healthInsurance = $this->healthInsurance->find($id);
           if($healthInsurance) {
            $healthInsurance->delete();
            return response()->json("HealthInsurance Deleted Successfully!", 200);
           }
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }
}
