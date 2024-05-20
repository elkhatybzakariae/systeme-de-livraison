<?php

namespace Database\Seeders;

use App\Models\DemandeModificationColi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemandeModificationColiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        DemandeModificationColi::factory(10)->create();
    }
}
