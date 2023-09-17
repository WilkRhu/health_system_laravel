<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Validation\Rule;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $rolesUserUpdate = [
        "email" =>  "email:rfc,dns|unique:users",
        "medical_crm" => "nullable|string",
        "date_of_birth_patient" => "nullable|string",
        "phone_number_patient" => "nullable|string",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_type' => $this->user_type
        ];
    }
}
