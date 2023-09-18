<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HealthInsurance extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    protected $fillable = [
        "description",
        "phone",
        "users_id",
        "contract_number"
    ];

    public $rules = [
        "description" => "required|string",
        "phone" => "required|string",
        "users_id" => "required|string",
        "contract_number" => "required|string"
    ];

    public $rulesUpdate = [
        "description" => "string",
        "phone" => "string",
        "users_id" => "string",
        "contract_number" => "string"
    ];
}
