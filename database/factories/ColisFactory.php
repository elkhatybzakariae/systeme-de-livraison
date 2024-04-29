<?php

namespace Database\Factories;

use App\Models\Colis;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colis>
 */
class ColisFactory extends Factory
{
    protected $model = Colis::class;

    public function definition()
    {
        return [
            'id_C' => Str::random(10),
            'code_d_envoi' => $this->faker->unique()->text(10),
            'date_d_expedition' => $this->faker->date(),
            'etat' => $this->faker->word,
            'status' => $this->faker->word,
            'ville_id' => function () {
                return \App\Models\Ville::factory()->create()->id_V;
            },
            'prix' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
