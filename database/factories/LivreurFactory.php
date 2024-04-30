<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livreur>
 */
class LivreurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Liv' => Str::random(10),
            'nomcomplet' => fake()->name(),
            'cin' => Str::random(10),
            'email' =>fake()->unique()->safeEmail() ,
            'Phone' => Str::phoneNumber(),
            'ville' => fake()->city(),
            'adress' => fake()->address(),
            'fraislivraison' => fake()->randomNumber(2),
            'fraisrefus' => fake()->randomNumber(2),
            'nombanque' => fake()->company(),
            'numerocompte' => fake()->randomNumber(10),
            'password' => Hash::make('password'),
            // 'cinrecto' => fake()->randomNumber(10),
            // 'cinverso' => fake()->boolean(),
            // 'RIB' => ,
        ];
    }
}
