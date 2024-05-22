<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zone>
 */
class ZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Z'=>Str::random(10),
            'zonename'=>$this->faker->state(),
            'statut'=>$this->faker->numberBetween($min = 0, $max = 1),
            'created_at'=>now()

        ];
    }
}
