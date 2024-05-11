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
        $zones = Zone::pluck('id_Z')->toArray();
        $villes = Ville::pluck('id_V')->toArray();
        $clients = Client::pluck('id_Cl')->toArray();

        return [
            'id'=>Str::random(10),
            'code_d_envoi' => fake()->unique()->randomNumber(),
            'date_d_expedition' => fake()->dateTimeBetween('-1 year', 'now'),
            'destinataire' => fake()->name,
            'id_Cl' => fake()->randomElement($clients),
            'telephone' => fake()->phoneNumber,
            'marchandise' => fake()->word,
            'etat' => fake()->randomElement(['paye','non paye']),
            'status' => fake()->randomElement(['nouveau','recu','livraison','distribution','livre']),
            'zone' => fake()->randomElement($zones),
            'ville_id' => fake()->randomElement($villes),
            'prix' => fake()->randomFloat(2, 10, 1000),
            'quantite' => fake()->numberBetween(1, 10),
            'commentaire' => fake()->sentence,
            'adresse' => fake()->address,
            'fragile' => fake()->boolean,
            'ouvrir' => fake()->boolean,
            'colis_a_remplacer' => fake()->boolean,
        ];
    }}
