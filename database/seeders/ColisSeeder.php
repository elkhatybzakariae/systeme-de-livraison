<?php

namespace Database\Seeders;

use App\Models\Colis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Colis::factory()->count(10)->create();
        $clients = DB::table('clients')->pluck('id_Cl')->toArray();
        $zones = DB::table('zones')->pluck('id_Z')->toArray();
        $cities = DB::table('villes')->pluck('id_V')->toArray();
        if (empty($clients) || empty($zones) || empty($cities)) {
            $this->command->error('Clients, Zones, and Cities tables must have data before seeding Colis.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $colisId = Str::uuid()->toString();
            $clientId = 'iecFC3g7Jx';
            $zoneId = $zones[array_rand($zones)];
            $cityId = $cities[array_rand($cities)];

            DB::table('colis')->insert([
                'id' => $colisId,
                'code_d_envoi' => Str::random(10),
                'date_d_expedition' => now(),
                'destinataire' => 'Destinataire ' . $i,
                'id_Cl' => $clientId,
                'telephone' => '0123456789',
                'marchandise' => 'Marchandise ' . $i,
                'etat' => 'non paye',
                'status' => 'nouveau',
                'zone' => $zoneId,
                'ville_id' => $cityId,
                'prix' => rand(100, 1000),
                'quantite' => rand(1, 10),
                'commentaire' => 'Commentaire ' . $i,
                'adresse' => 'Adresse ' . $i,
                'fragile' => false,
                'ouvrir' => false,
                'colis_a_remplacer' => false,
                'barcode' => null,
                'id_BL' => null,
                'id_BE' => null,
                'id_BD' => null,
                'id_BPL' => null,
                'id_BRL' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('colisinfo')->insert([
                'info' => 'Info for Colis ' . $i,
                'id' => $colisId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
