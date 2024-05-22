<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Cl' => Str::random(10),
            'nommagasin' => fake()->company(),
            'nomcomplet' => fake()->name(),
            'typeentreprise' =>fake()->name() ,
            'cin' => Str::random(10),
            'email' => fake()->unique()->safeEmail(),
            'Phone' => fake()->phoneNumber(),
            'ville' => fake()->city(),
            'villeRamassage' => fake()->city(),
            'adress' => fake()->address(),
            'siteweb' => fake()->url(),
            'nombanque' => fake()->company(),
            'numerocompte' => $this->faker->optional()->bankAccountNumber,
            'isAdmin' => fake()->boolean(),
            'password' => Hash::make('password'),
            'created_at'=>now()

        ];
    }
}
