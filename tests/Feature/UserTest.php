<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_users() 
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->login['access_token'],
        ])->get('/api/user');

        $response->assertStatus(200);
    }

    public function test_get_user_id()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->login['access_token'],
        ])->get('/api/user/show/'.$this->login['user']['id']);

        $response->assertStatus(200);
    }

    public function test_update_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->login['access_token'],
        ])->put('/api/user/update/'.$this->login['user']['id'], [
            "name" => "Teste Name"
        ]);

        $response->assertStatus(201);
        $this->assertEquals($response['name'], "Teste Name");


    }

    public function test_destroy_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->login['access_token'],
        ])->delete('/api/user/destroy/'.$this->login['user']['id']);


        $response->assertStatus(200);
        $this->assertEquals(trim($response->getContent(), '"'), "User Deleted Successfully!");

    }
}