<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depense>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        $userIds = User::pluck('id_U')->toArray();
        return [
            'depense' => fake()->name(),
            'description' => fake()->paragraph(),
            'montant' => fake()->randomNumber(),
            'datedep' =>now(),
            'id_U' => fake()->randomElement($userIds),
        ];
    }
}
