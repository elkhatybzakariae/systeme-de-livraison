<?php

namespace Database\Seeders;

use App\Models\Reclamation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReclamationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reclamation::factory()->count(10)->create();

    }
}
