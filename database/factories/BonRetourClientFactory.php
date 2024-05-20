<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonRetourClient>
 */
class BonRetourClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_BRC' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'reference' => $this->faker->unique()->numerify('REF#####'),
            'id_CL' => Client::factory()->create()->id_CL,
            'status' => $this->faker->randomElement(['Nouveau', 'En Cours', 'Terminé']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
