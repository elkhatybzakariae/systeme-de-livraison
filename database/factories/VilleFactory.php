<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ville>
 */
class VilleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $zoneIds = Zone::pluck('id_Z')->toArray();
        return [
            'id_V' => Str::random(10),
            'ref' => $this->faker->city(),
            'villename' => $this->faker->city(),
            'statut' => $this->faker->numberBetween($min = 0, $max = 1),
            'id_Z' => $this->faker->randomElement($zoneIds),

        ];
    }
}
