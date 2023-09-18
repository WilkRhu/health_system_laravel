<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Services\AppointmentsServices;

class AppointmentController extends Controller
{
    
    private $appointment;
    private $appointment_service;

    public function __construct(
        Appointment $appointment,
        AppointmentsServices $appointment_service
        ) {
        $this->appointment = $appointment;
        $this->appointment_service = $appointment_service;
    }

    public function index()
    {
        try {
            $appointment = $this->appointment->all();
            return response()->json($appointment, 200);
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
            $validate = validator($request->all(), $this->appointment->rules);

            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }
            $appointment = $this->appointment->create([
                "user_id_medical" => $request->user_id_medical,
                "user_id_patient" => $request->user_id_patient,
                "procedures_id" => $request->procedures_id,
                "date" => $request->date,
                "hours" => $request->hours,
                "private" => $request->private,
            ]);
            $appointment_return = $this->appointment_service
                                        ->handle_return_appointment($appointment);
            return response()->json([
                "appointment" => $appointment_return,
                "message" => 'Appointment Created Successfully'
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
            $appointment = $this->appointment->find($id);
            return response()->json($appointment, 200);
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
            $validate = validator($request->all(), $this->appointment->rules);
            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $appointment = $this->appointment->find($id);
            if($appointment) {
                $date = $request->all();
                $appointment->update($date);

                return response()->json($appointment, 201);
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
            $appointment = $this->appointment->find($id);
           if($appointment) {
            $appointment->delete();
            return response()->json("Appointment Deleted Successfully!", 200);
           }
        } catch (\Exception $ex) {
            return response()->json([
                'error_message' => $ex->getMessage(),
                'status' => $ex->getCode()
               ]);
        }
    }
}
