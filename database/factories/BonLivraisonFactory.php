<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Colis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BonLivraison>
 */
class BonLivraisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientIds = Client::pluck('id_Cl')->toArray();

        return [
            'reference' => 'BL-'.Str::random(10),
            'id_Cl' => fake()->randomElement($clientIds),
            'id_BL' => $this->faker->unique()->regexify('[A-Z0-9]{15}'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
