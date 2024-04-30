<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Ad' => Str::random(10),
            'nommagasin' => fake()->company(),
            'nomcomplet' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'Phone' => fake()->phoneNumber(),
            'ville' => fake()->city(),
            'adress' => fake()->address(),
            'nombanque' => fake()->company(),
            'numerocompte' => fake()->randomNumber(10),
            'isAdmin' => fake()->boolean(),
            'password' => Hash::make('password'),
        ];
    }
}
