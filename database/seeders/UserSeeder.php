<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Fulano de Tal",
            "email" => "fulano@mail.com",
            "password" => bcrypt("123456"),
            "user_type" => "admin"
        ]);
    }
}
