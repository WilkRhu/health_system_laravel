<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

       $this->artisan('migrate');

       $this->make = User::factory()->make();

       $this->user = $this->post('/api/register', [
            "name" => $this->make->name,
            "email" => $this->make->email,
            "password" => $this->make->password,
            "user_type" => $this->make->user_type
       ]);

       $this->login = $this->post('/api/login', [
            "email" => $this->make->email,
            "password" => $this->make->password,
       ]);

    }
}
