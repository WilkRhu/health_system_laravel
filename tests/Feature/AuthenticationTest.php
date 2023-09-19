<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login() 
    {

       $response =  $this->post('/api/login', [
            "email" => $this->user->json()['user']['email'],
            "password" => $this->make->password
       ]);

       $response->assertStatus(200);
       $this->assertNotEmpty($response->json()['access_token']);
    }
}