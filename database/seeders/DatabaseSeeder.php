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
        
        $this->call(ZoneSeeder::class);
        $this->call(VilleSeeder::class);

        \App\Models\Admin::factory()->create([
                'email' => 'admin@gmail.com',
                'role'=>'Admin',
                'isAdmin'=>1,
                'password' => Hash::make('password'),
            ]);
        \App\Models\Admin::factory()->create([
                'email' => 'a@gmail.com',
                'role'=>'Moderateur',
                'isAdmin'=>0,
                'password' => Hash::make('password'),
            ]);
        \App\Models\Admin::factory()->create([
                'email' => 'a@a.com',
                'role'=>'Equipe de suivi',
                'isAdmin'=>0,
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
        \App\Models\Livreur::factory(20)->create([
                'isAccepted'=>0
            ]);
        \App\Models\Livreur::factory()->create([
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
           
        \App\Models\Admin::factory(10)->create();
        $this->call(ColisSeeder::class);
        $this->call(DepenseSeeder::class);
        $this->call(TarifSeeder::class);
        $this->call(ReclamationSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(RamassagecoliSeeder::class);
        $this->call(RemarqueSeeder::class);
        $this->call(DemandeModificationColiSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(EtatSeeder::class);
    }
}
