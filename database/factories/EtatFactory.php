<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etat>
 */
class EtatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomInteger = $this->faker->unique()->numberBetween(0, 16777215);

        // Convert the integer to hexadecimal format
        $hexColor = sprintf('#%06X', $randomInteger);
        $status = $this->faker->randomElement([
            'Paye', 'Non Paye','Facture','Paye a Client'
        ]);
        return [
            'couleur' => $hexColor,
            'code' => $status,
            'nom' => $status,
            'created_at'=>now()
        ];
    }
}
