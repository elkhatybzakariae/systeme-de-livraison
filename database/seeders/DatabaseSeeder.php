<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);
            
        \App\Models\Admin::factory(10)->create();
        $this->call(ZoneSeeder::class);
        $this->call(ColisSeeder::class);
        $this->call(DepenseSeeder::class);
        $this->call(TarifSeeder::class);
        $this->call(VilleSeeder::class);
    }
}
