<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reclamationIds = Reclamation::pluck('id_Rec')->toArray();
        $adminIds = Admin::pluck('id_Ad')->toArray();
        return [
            'id_Mess' => Str::random(10),
            'message' => fake()->name(),
            'id_Rec' => fake()->randomElement($reclamationIds),
            'id_Ad'=>fake()->randomElement([null,fake()->randomElement($adminIds)]),
            
        ];
    }
}
