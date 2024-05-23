<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Paye', 'Non Paye'
        ];

        foreach ($statuses as $status) {
            Etat::factory()->create([
                'code' => $status,
                'nom' => $status
            ]);
        }
    }
}
