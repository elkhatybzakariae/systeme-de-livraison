<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Colis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reclamamtion>
 */
class ReclamationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colisIds = Colis::pluck('id_C')->toArray();
        $clientIds = Client::pluck('id_Cl')->toArray();
        return [
            'id_Rec' => Str::random(10),
            'objet' => fake()->name(),
            'etat' => fake()->boolean(),
            'id_C' => fake()->randomElement($colisIds),
            'id_Cl' => fake()->randomElement($clientIds),
        ];
    }
}
