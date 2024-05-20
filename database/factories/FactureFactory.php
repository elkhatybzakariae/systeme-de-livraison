<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_F' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'reference' => $this->faker->unique()->numerify('REF#####'),
            'date_paiment' => $this->faker->date(),
            'id_CL' => Client::factory()->create()->id_CL,
            'id_Ad' => Admin::query()->first()->id_Ad,
            'status' => $this->faker->randomElement(['Brouillon', 'En Attente', 'Payé']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
