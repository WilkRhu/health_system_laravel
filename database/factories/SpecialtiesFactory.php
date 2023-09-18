<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class SpecialtiesFactory extends Factory
{
  
    public function definition(): array
    {
        return [
            'specialties_type' => 'sepecialties'.rand(1, 10000)
        ];
    }
}
