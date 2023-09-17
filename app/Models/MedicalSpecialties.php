<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSpecialties extends Model
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
        "user_id",
        "specialties_id"
    ];

    public $rules = [
        "user_id" => "required|max:60|min:3",
        "specialties_id" => "required|max:60|min:3",
    ];

}
