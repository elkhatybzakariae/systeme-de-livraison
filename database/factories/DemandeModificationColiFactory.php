<?php

namespace Database\Factories;

use App\Models\Colis;
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
        return [
            
            'id_DMC'=>Str::random(10),
            'destinataire' => fake()->name,            
            'telephone' => fake()->phoneNumber,
            'adresse' => fake()->address,
            'commentaire' => fake()->sentence,
            'prix' => fake()->randomFloat(2, 10, 1000),
            'isAccepted' => fake()->randomElement([ 'Nouveau','Annule', 'Accepte']),
            // 'fragile' => fake()->boolean,
            // 'ouvrir' => fake()->boolean,
            'id' => fake()->randomElement($colis),
            'created_at'=>now()

        ];
    }
}
