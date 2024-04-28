<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarif>
 */
class TarifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $villeIds = Ville::pluck('id_V')->toArray();

        return [
            'id_V' => $this->faker->randomNumber(),
            'ref' => $this->faker->city(),
            'villename' => $this->faker->city(),
            'statut' => $this->faker->numberBetween($min = 0, $max = 1),
            'id_Z' => $this->faker->randomElement($villeIds),
        ];
    }
}
