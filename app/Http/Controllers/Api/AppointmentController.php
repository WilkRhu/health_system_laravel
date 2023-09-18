<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    
    private $appointment;

    public function __construct(Appointment $appointment) {
        $this->appointment = $appointment;
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
            $privateString = $request->input('private');
            $private = filter_var($privateString, FILTER_VALIDATE_BOOLEAN);
            $request->merge(['private' => $private]);

            $validate = validator($request->all(), $this->appointment->rules);

            if ($validate->fails()) {
                return response()
                    ->json($validate->errors(), 400);
            }

            $appointment = $this->appointment->create([
                "private" => $request->private
            ]);
            return response()->json([
                "appointment" => $appointment,
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
