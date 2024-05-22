<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Pro'=>Str::random(10),
            'imgpro' => fake()->image(),
            'nompro' => fake()->name,
            'refpro' => fake()->name(),
            'quantitie' => fake()->numberBetween(1, 10),
            'description' => fake()->text(),
            'id_Cl' => function () {
                return Client::factory()->create()->id_Cl;
            },
            'created_at'=>now()

        ];
    }
}
