<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Ville;
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
        $admins = Admin::pluck('id_Ad')->toArray();
        $villes = Ville::pluck('id_V')->toArray();
        return [
            'id_Cl' => Str::random(10),
            'nommagasin' => fake()->company(),
            'nomcomplet' => fake()->name(),
            'typeentreprise' =>fake()->name() ,
            'cin' => Str::random(10),
            'email' => fake()->unique()->safeEmail(),
            'Phone' => fake()->phoneNumber(),
            'ville' =>fake()->randomElement($villes),
            // 'villeRamassage' => fake()->city(),
            'adress' => fake()->address(),
            'siteweb' => fake()->url(),
            'nombanque' => fake()->company(),
            'numerocompte' => $this->faker->optional()->bankAccountNumber,
            'isActive' => fake()->boolean(),
            'isAdmin' => fake()->boolean(),
            // 'acceptedBy' => fake()->randomElement($admins),
            'password' => Hash::make('password'),
            'created_at'=>now()

        ];
    }
}
