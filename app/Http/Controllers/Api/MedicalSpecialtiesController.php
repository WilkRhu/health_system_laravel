<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalSpecialties;
use App\Models\Specialties;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalSpecialtiesController extends Controller
{
    private $medicalSpecialties;
    private $user;
    private $specialties;
    
    public function __construct(
        MedicalSpecialties $medicalSpecialties, 
        User $user, 
        Specialties $specialties
        )
    {
        $this->medicalSpecialties = $medicalSpecialties;
        $this->user  = $user;
        $this->specialties = $specialties;
    }

    public function index()
    {
        try {
            $medicalSpecialties = $this->medicalSpecialties->all();
            return response()->json($medicalSpecialties, 200);
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
            $user = $this->user->find($request->users_id);
            $name_specialties = $this->specialties->find($request->specialties_id);

            if($user->user_type === 'medical') {
                $validate = validator($request->all(), $this->medicalSpecialties->rules);
                if($validate->fails()) {
                    return response()
                        ->json($validate->errors(), 400);
                } 
                $medicalSpecialties = $this->medicalSpecialties->create([
                    "users_id" => $request->users_id,
                    "specialties_id" => $request->specialties_id
                ]);
    
                return response()->json([
                    "created" => ["user" =>  $user, "medical_specialties" => $name_specialties->specialties_type],
                    "message" => 'Medical Specialties Created Successfully',
                ]);
            }
            throw new \Exception('This user is not the medical type', 400);
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
            $medicalSpecialties = $this->medicalSpecialties->find($id);
            return response()->json($medicalSpecialties, 200);
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }

  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $medicalSpecialties = $this->medicalSpecialties->find($id);
            if($medicalSpecialties) {
             $medicalSpecialties->delete();
             return response()->json("Medical Specialties Deleted Successfully!", 200);
            }
         } catch (\Exception $ex) {
             return response()->json([
                 'error_message' => $ex->getMessage(),
                 'status' => $ex->getCode()
             ]);
         }
    }
}
