<?php

namespace Database\Factories;

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
        return [
            'id_Mess' => Str::random(10),
            'message' => fake()->name(),
            'id_Rec' => fake()->randomElement($reclamationIds),
            
        ];
    }
}
