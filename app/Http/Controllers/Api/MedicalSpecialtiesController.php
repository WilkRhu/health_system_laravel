<?php

namespace App\Http\Controllers;

use App\Models\MedicalSpecialties;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalSpecialtiesController extends Controller
{
    private $medicalSpecialties;
    private $user;
    
    public function __construct(MedicalSpecialties $medicalSpecialties, User $user)
    {
        $this->medicalSpecialties = $medicalSpecialties;
        $this->user  = $user;
    }

   
  
    public function store(Request $request)
    {
        try {
            $validate = validator($request->all(), $this->medicalSpecialties->rules);
            if($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            } 
            $medicalSpecialties = $this->specialties->create([
                "user_id" => $request->user_id,
                "specialties_id" => $request->specialties_id
            ]);

            $user = $this->user->find($request->user_id);
            return response()->json([
                "specialties_type" => $specialties,
                "message" => 'Medical Specialties Created Successfully',
                "user_name" => $user->name
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }

   
    public function show(MedicalSpecialties $medicalSpecialties)
    {
        //
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalSpecialties $medicalSpecialties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalSpecialties $medicalSpecialties)
    {
        //
    }
}
