<?php

namespace Database\Factories;

use App\Models\Colis;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class DemandeModificationColiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colis = Colis::pluck('id')->toArray();
        $z = Zone::pluck('id_Z')->toArray();
        $v = Ville::pluck('id_V')->toArray();
        return [
            
            'id_DMC'=>Str::random(10),
            'destinataire' => fake()->name,            
            'telephone' => fake()->phoneNumber,
            'marchandise' => fake()->phoneNumber,
            'adresse' => fake()->address,
            'commentaire' => fake()->sentence,
            'quantite' => fake()->randomNumber(2, 10),
            'prix' => fake()->randomFloat(2, 10, 1000),
            'isAccepted' => fake()->randomElement([ 'Nouveau','Annule', 'Accepte']),
            // 'fragile' => fake()->boolean,
            // 'ouvrir' => fake()->boolean,
            'zone' => fake()->randomElement($z),
            'ville_id' => fake()->randomElement($v),
            'id' => fake()->randomElement($colis),
            'created_at'=>now()

        ];
    }
}
