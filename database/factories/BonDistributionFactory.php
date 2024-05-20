<?php

namespace Database\Factories;

use App\Models\Livreur;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonDistribution>
 */
class BonDistributionFactory extends Factory
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
            'id_BD' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'reference' => $this->faker->unique()->numerify('REF#####'),
            'id_Liv' => Livreur::factory()->create()->id_Liv,
            'id_Z' => Zone::factory()->create()->id_Z,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
