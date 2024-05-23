<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { $randomInteger = $this->faker->unique()->numberBetween(0, 16777215);

        // Convert the integer to hexadecimal format
        $hexColor = sprintf('#%06X', $randomInteger);
        $status = $this->faker->randomElement([
            'Nouveau', 'Mise en distribution', 'Expedie', 'En livraison',
            'Attente de Ramassage', 'Ramasse', 'En voyage', 'Recu', 'Livraison',
            'Distribution', 'Retourne', 'Livre', 'Reporte', 'Pas de Reponse',
            'Injoignable', 'Hors-Zone', 'Annule', 'Refuse', 'Numero Errone',
            'Deuxieme Appel', 'Programme', 'Boite vocale', 'Client interesse',
            'Expedier vers Centre Retour', 'Recu par Centre Retour',
            'Expedier vers Centre Principale', 'Recu par Centre Principale',
            'Expedier vers Client', 'Recu par Client'
        ]);
        return [
            'couleur' => $hexColor,
            'code' => $status,
            'nom' => $status,
            'created_at'=>now()
        ];
    }
}
