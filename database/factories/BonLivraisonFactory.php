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
        $colisIds = Colis::pluck('id_C')->toArray();

        return [
            'reference' => 'BL-'.Str::random(10),
            'id_Cl' => fake()->randomElement($clientIds),
            'statut' => $this->faker->randomElement(['pending', 'processing', 'delivered']),
            // 'id_C' => fake()->randomElement($colisIds),
        ];
    }
}
