<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ramassagecoli>
 */
class RamassagecoliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = Client::pluck('id_Cl')->toArray();

        return [
            'id_Ram' => $this->faker->unique()->uuid,
            'remarque' => fake()->sentence,
            'telephone' => fake()->phoneNumber,
            'adresse' => fake()->address,
            'tybe' => fake()->sentence, 
            'ville' => fake()->city,
            'etat' => fake()->randomElement(['Nouvelle demande', 'Demande recue', 'Demande traitee']),
            'id_Cl' => fake()->randomElement($userIds),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
