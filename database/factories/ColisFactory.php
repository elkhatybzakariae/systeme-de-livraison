<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Colis;
use App\Models\Ville;
use App\Models\Zone;
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
            'id_C'=>fake()->unique()->text(),
            'code_d_envoi' => fake()->unique()->randomNumber(),
            'date_d_expedition' => fake()->dateTimeBetween('-1 year', 'now'),
            'destinataire' => fake()->name,
            'id_Cl' => function () {
                return Client::factory()->create()->id_Cl;
            },
            'telephone' => fake()->phoneNumber,
            'marchandise' => fake()->word,
            'etat' => fake()->randomElement(['Pending', 'In Transit', 'Delivered']),
            'status' => fake()->randomElement(['Pending', 'Processed', 'Shipped']),
            'zone' => function () {
                return Zone::factory()->create()->id_Z;
            },
            'ville_id' => function () {
                return Ville::factory()->create()->id_V;
            },
            'prix' => fake()->randomFloat(2, 10, 1000),
            'quantite' => fake()->numberBetween(1, 10),
            'commentaire' => fake()->sentence,
            'adresse' => fake()->address,
            'fragile' => fake()->boolean,
            'ouvrir' => fake()->boolean,
            'colis_a_remplacer' => fake()->boolean,
        ];
    }}
