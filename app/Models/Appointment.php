<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
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
        "user_id_medical",
        "user_id_patient",
        "procedures_id",
        "date",
        "hours",
        "private"
    ];

    public $rules = [
        "user_id_medical" => "required|string",
        "user_id_patient" => "required|string",
        "procedures_id" => "required|string",
        "date" => "string",
        "hours" => "string",
        "private" => "required|string",
    ];
}
