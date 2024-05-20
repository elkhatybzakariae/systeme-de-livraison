<?php

namespace Database\Factories;

use App\Models\Livreur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonEnvois>
 */
class BonEnvoisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id_BE' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'reference' => $this->faker->unique()->numerify('REF#####'),
            'id_Liv' => Livreur::factory()->create()->id_Liv, // Assumes LivreurFactory exists
            'status' => $this->faker->randomElement(['nouveau', 'recu']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
