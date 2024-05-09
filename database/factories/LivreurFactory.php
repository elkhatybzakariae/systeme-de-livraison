<?php

namespace Database\Factories;

use App\Models\Zone;
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
        $adminIds = Zone::pluck('id_Z')->toArray();
        // dump($adminIds);
        return [
            'id_Liv' => Str::random(10),
            'nomcomplet' => fake()->name(),
            'cin' => Str::random(10),
            'email' => fake()->unique()->safeEmail(),
            'Phone' => fake()->phoneNumber(),
            'ville' => fake()->city(),
            'adress' => fake()->address(),
            'fraislivraison' => fake()->numberBetween(10, 50),
            'fraisrefus' => fake()->numberBetween(10, 50),
            'nombanque' => fake()->company(),
            'numerocompte' => fake()->numberBetween(10, 50),
            'password' => Hash::make('password'),
            'cinrecto' => fake()->imageUrl(), // Example for cinrecto, you should replace this with proper logic to handle file uploads
            'cinverso' => fake()->imageUrl(), // Example for cinverso, you should replace this with proper logic to handle file uploads
            'RIB' => fake()->imageUrl(), // Example for RIB, you should replace this with proper logic to handle file uploads
            'isAccepted' => fake()->boolean(),
            'id_Z'=>fake()->randomElement($adminIds),

        ];
    }
}
