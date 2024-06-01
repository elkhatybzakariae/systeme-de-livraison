<?php

namespace Database\Factories;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FraisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Fac = Facture::pluck('id_F')->toArray();
        return [
            'id_Fr' => Str::random(10),
            'title' => fake()->name,
            'prix' => fake()->randomFloat(2, 10, 1000),
            'id_F' =>fake()->randomElement($Fac),
            'created_at' => now()
        ];
    }
}
