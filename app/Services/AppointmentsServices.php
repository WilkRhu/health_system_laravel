<?php

namespace App\Services;

use App\Models\User;
use App\Models\Procedures;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;


class AppointmentsServices {
    private $user;
    private $procedure;
    private $appointment;

    public function __construct(
        User $user,
        Procedures $procedure,
        Appointment $appointment
    ) {
        $this->user = $user;
        $this->procedure = $procedure;
        $this->appointment = $appointment;
    }

    public function handle_return_appointment($appointment) {
        return 
            [
                "medical_name" => $this->handle_medical($appointment->user_id_medical, $appointment->id),
                "patient_name" => $this->handle_patient($appointment->user_id_patient, $appointment->id),
                "procedure" => $this->handle_procedure($appointment->procedures_id, $appointment->id),
                "date" => $appointment->date,
                "hours" => $appointment->hours,
                "private" => $appointment->private
            ];
        
    
    }

    public function handle_medical($user_id_medical, $appointments_id) {
        $user = $this->user->find($user_id_medical);
        if($user && $user->user_type === 'medical') {
            DB::table('appointments_medic')->insert([
                'users_id' => $user->id,
                'appointments_id' =>  $appointments_id
            ]);
            return $user->name;
        }
    }

    public function handle_patient($user_id_patient, $appointments_id) {
        $user = $this->user->find($user_id_patient);
        if($user && $user->user_type === 'patient') {
            DB::table('appointments_patient')->insert([
                'users_id' => $user->id,
                'appointments_id' =>  $appointments_id
            ]);
            return $user->name;
        }
    }

    public function handle_procedure($procedures_id, $appointment_id) {
        $procedure = $this->procedure->find($procedures_id);
        if($procedure) {
            DB::table('appointments_procedure')->insert([
                'procedures_id' => $procedures_id,
                'appointments_id' =>  $appointment_id
            ]);
            return [
                "name" => $procedure->procedure_name,
                "value" => $procedure->procedure_value
            ];
        }
    }
}