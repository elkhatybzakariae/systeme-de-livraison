<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depense>
 */
class DepenseFactory extends Factory
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
            'id_Dep' => Str::random(10),
            'depense' => fake()->name(),
            'description' => fake()->paragraph(),
            'montant' => fake()->randomNumber(),
            'datedep' =>now(),
            'id_Ad' => fake()->randomElement($userIds),
        ];
    }
}
