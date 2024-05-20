<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonPaymentZone>
 */
class BonPaymentZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_BPZ' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'reference' => $this->faker->unique()->numerify('REF#####'),
            'id_Z' => Zone::factory()->create()->id_Z,
            'status' => $this->faker->randomElement(['Attente Paiement', 'Paiement Effectué']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
