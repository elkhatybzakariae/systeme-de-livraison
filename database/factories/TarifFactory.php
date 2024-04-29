<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'id_Tar' => Str::random(10),
            'villeRamassage' => $this->faker->randomElement($villeIds),
            'ville' => $this->faker->randomElement($villeIds),
            'prixliv' => $this->faker->randomFloat(2, 0, 1000),
            'prixret' => $this->faker->randomFloat(2, 0, 1000),
            'prixref' => $this->faker->randomFloat(2, 0, 1000),
            'delailiv' => $this->faker->sentence,
            
        ];
    }
}
