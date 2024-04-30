<?php

namespace Database\Seeders;

use App\Models\Livreur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivreurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Livreur::factory(10)->create();
    }
}
