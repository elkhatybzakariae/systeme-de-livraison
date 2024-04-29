<?php

namespace Database\Seeders;

use App\Models\Colis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colis::factory()->count(10)->create();
    }
}
