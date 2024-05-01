<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        \App\Models\Admin::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        \App\Models\Client::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        \App\Models\Livreur::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
            
        \App\Models\Admin::factory(10)->create();
        $this->call(ZoneSeeder::class);
        $this->call(ColisSeeder::class);
        $this->call(DepenseSeeder::class);
        $this->call(TarifSeeder::class);
        $this->call(VilleSeeder::class);
    }
}
