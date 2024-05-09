<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Colis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(ZoneSeeder::class);
        \App\Models\Admin::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        \App\Models\Client::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'id_Cl'=>'iecFC3g7Jx',
                'isAccepted'=>1
            ]);
        \App\Models\Client::factory(10)->create([
                'isAccepted'=>0
            ]);
        \App\Models\Livreur::factory(60)->create([
                'isAccepted'=>0
            ]);
        \App\Models\Livreur::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
            Colis::factory(5)->create([
                'id_Cl'=>'iecFC3g7Jx',

            ]);
        \App\Models\Admin::factory(10)->create();
        $this->call(ColisSeeder::class);
        $this->call(DepenseSeeder::class);
        $this->call(TarifSeeder::class);
        $this->call(VilleSeeder::class);
        $this->call(ReclamationSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
