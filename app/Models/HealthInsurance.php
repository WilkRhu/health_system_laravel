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
        "phone"
    ];

    public $rules = [
        "description" => "required|string",
        "phone" => "required|string",
    ];

    public $rulesUpdate = [
        "description" => "string",
        "phone" => "string",
    ];
}
