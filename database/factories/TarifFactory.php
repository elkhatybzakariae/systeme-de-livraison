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
            'id_Tar' => $this->faker->randomNumber(),
            'villeRamassage' => $this->faker->randomElement($villeIds),
            'ville' => $this->faker->randomElement($villeIds),
            'prixliv' => $this->faker->randomNumber(),
            'prixret' => $this->faker->randomNumber(),
            'prixref' => $this->faker->randomNumber(),
            'delailiv' => $this->faker->randomNumber($min = 0, $max = 100),
        ];
    }
}
