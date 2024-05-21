<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remarque>
 */
class RemarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = Admin::pluck('id_Ad')->toArray();
        return [
            'id_Rem' => $this->faker->unique()->uuid,
            'remarque' => fake()->sentence,
            'type' => fake()->randomElement(['Information', 'Important', 'Urgence']),
            'cible' => fake()->randomElement(['Vendeur', 'Livreur', 'Equipe de suivi','Moderateur']),
            'section' => fake()->randomElement(['Accueil', 'Reclamations', 'List Colis',
            'Bons de livraison', 'Bon de retour', 'Factures']),
            'id_Ad' => fake()->randomElement($userIds),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
