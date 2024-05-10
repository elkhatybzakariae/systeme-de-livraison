<?php

namespace Database\Seeders;

use App\Models\Remarque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Remarque::factory()->count(10)->create();

    }
}
