<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_Ad' => $this->faker->unique()->uuid,
            'nommagasin' => $this->faker->company,
            'nomcomplet' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'Phone' => $this->faker->optional()->phoneNumber,
            'ville' => $this->faker->city,
            'adress' => $this->faker->address,
            'nombanque' => $this->faker->optional()->company,
            'numerocompte' => $this->faker->optional()->bankAccountNumber,
            'isAdmin' => $this->faker->boolean,
            'password' => bcrypt('password'),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        
        ];
    }
}
