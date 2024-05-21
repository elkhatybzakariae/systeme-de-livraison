<?php

namespace Database\Seeders;

use App\Models\BonDistribution;
use App\Models\BonEnvois;
use App\Models\BonLivraison;
use App\Models\BonPaymentLivreur;
use App\Models\Colis;
use App\Models\Facture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColisSeeder extends Seeder
{

    public function run(): void
    {
        $clients = DB::table('clients')->pluck('id_Cl')->toArray();
        $zones = DB::table('zones')->pluck('id_Z')->toArray();
        $cities = DB::table('villes')->pluck('id_V')->toArray();
        if (empty($clients) || empty($zones) || empty($cities)) {
            $this->command->error('Clients, Zones, and Cities tables must have data before seeding Colis.');
            return;
        }

//         for ($i = 0; $i < 5; $i++) {
//             $colisId = Str::uuid()->toString();
//             $clientId = 'iecFC3g7Jx';
//             $zoneId = $zones[array_rand($zones)];
//             $cityId = $cities[array_rand($cities)];
// 
//             DB::table('colis')->insert([
//                 'id' => $colisId,
//                 'code_d_envoi' => Str::random(10),
//                 'date_d_expedition' => now(),
//                 'destinataire' => 'Destinataire ' . $i,
//                 'id_Cl' => $clientId,
//                 'telephone' => '0123456789',
//                 'marchandise' => 'Marchandise ' . $i,
//                 'etat' => 'non paye',
//                 'status' => 'nouveau',
//                 'zone' => $zoneId,
//                 'ville_id' => $cityId,
//                 'prix' => rand(100, 1000),
//                 'quantite' => rand(1, 10),
//                 'commentaire' => 'Commentaire ' . $i,
//                 'adresse' => 'Adresse ' . $i,
//                 'fragile' => false,
//                 'ouvrir' => false,
//                 'colis_a_remplacer' => false,
//                 'barcode' => null,
//                 'id_BL' => null,
//                 'id_BE' => null,
//                 'id_BD' => null,
//                 'id_BPL' => null,
//                 'id_BRL' => null,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
// 
//             DB::table('colisinfo')->insert([
//                 'info' => 'Info for Colis ' . $i,
//                 'id' => $colisId,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }
        $statuses = [
            'Nouveau', 'Mise en distribution',
            'Expedie', 'En livraison',
            'Attente de Ramassage', 'Ramasse',
            'En voyage', 'Recu', 'Livraison',
            'Distribution', 'Retourne', 'Livre',
            'Hors-Zone', 'Annule', 'Refuse',
           
        ];

        foreach ($statuses as $status) {
            for ($i = 0; $i < 4; $i++) {
               

                switch ($status) {
                    case 'Nouveau':
                        $colis = Colis::factory()->create([
                            'status' => $status,
                        ]);
                        break;
                    case 'Attente de Ramassage':
                       $bl= BonLivraison::factory()->create([
                        'status' => 'Nouveau',
                    ]);
                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL
                        ]);
                        break;
                    case 'Ramasse':
                       $bl= BonLivraison::factory()->create([
                        'status' => 'Ramasse',
                       ]);
                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL
                        ]);
                        break;
                    case 'Expedie':
                        $bl= BonLivraison::factory()->create([
                            'status' => 'Ramasse',
                           ]);
                       $be= BonEnvois::factory()->create([
                        'status' => 'Nouveau',
                    ]);

                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL,
                            'id_BE'=>$be->id_BE
                        ]);
                        break;
                    case 'Recu':
                        $bl= BonLivraison::factory()->create([
                            'status' => 'Ramasse',
                           ]);
                       $be= BonEnvois::factory()->create([
                        'status' => 'Recu',
                       ]);

                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL,
                            'id_BE'=>$be->id_BE
                        ]);
                        break;
                    case 'Mise en distribution':
                        $bl= BonLivraison::factory()->create([
                            'status' => 'Ramasse',
                           ]);
                       $be= BonEnvois::factory()->create([
                        'status' => 'Recu',
                       ]);
                       $bd= BonDistribution::factory()->create([
                        'status' => 'Nouveau',
                    ]);
                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL,
                            'id_BE'=>$be->id_BE,
                            'id_BD'=>$bd->id_BD,
                        ]);
                        break;
                    case 'livre':
                        $bl= BonLivraison::factory()->create([
                            'status' => 'Ramasse',
                           ]);
                       $be= BonEnvois::factory()->create([
                        'status' => 'Recu',
                       ]);
                       $bd= BonDistribution::factory()->create([
                        'status' => 'Recu',
                       ]);
                       $bpl= BonPaymentLivreur::factory()->create([
                        'status' => 'Nouveau',
                    ]);
                        $colis = Colis::factory()->create([
                            'status' => $status,
                            'id_BL'=>$bl->id_BL,
                            'id_BE'=>$be->id_BE,
                            'id_BD'=>$bd->id_BD,
                            'id_BPL'=>$bpl->id_BPL,
                        ]);
                        break;
                   
                    default:
                    $colis = Colis::factory()->create([
                        'status' => $status,
                    ]);
                    $colis = Colis::factory()->create([
                        'status' => 'Nouveau',
                    ]);
                        break;
                }
                DB::table('colisinfo')->insert([
                    'info' => 'Info for Colis ' . $i,
                    'id' => $colis->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
