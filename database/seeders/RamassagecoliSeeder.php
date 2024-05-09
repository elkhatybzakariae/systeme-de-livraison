<?php

namespace Database\Seeders;

use App\Models\Ramassagecoli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RamassagecoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ramassagecoli::factory()->count(10)->create();
    }
}
