<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthInsurance;
use App\Services\HealthInsuranceService;

class HealthInsuranceController extends Controller
{

    private $healthInsurance;
    private $healthInsuranceService;
  
    
    public function __construct(HealthInsurance $healthInsurance, HealthInsuranceService $healthInsuranceService)
    {
        $this->healthInsurance = $healthInsurance;
        $this->healthInsuranceService = $healthInsuranceService;
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

            $healthInsurance = $this->healthInsuranceService->handle_insurance($request->all());
            return response()->json($healthInsurance, 200);
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
