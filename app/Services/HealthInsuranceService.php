<?php

namespace App\Services;

use App\Models\User;
use App\Models\HealthInsurance;
use Illuminate\Support\Facades\DB;



class HealthInsuranceService {
    private $user;
    private $healthinsurance;

    public function __construct(User $user, HealthInsurance $healthinsurance) {
        $this->user = $user;
        $this->healthinsurance = $healthinsurance;
    }

    public function handle_insurance($data){
        $user = $this->user->find($data['users_id']);
        if($user && $user->user_type === 'patient') {
            $insurance = $this->healthinsurance->create($data);
            return [
                "user" => $user,
                "helthinsurance" => $insurance

            ];
        }
    }
}