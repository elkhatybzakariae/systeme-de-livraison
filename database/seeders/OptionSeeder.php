<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Nouveau', 'Mise en distribution', 'Expedie', 'En livraison',
            'Attente de Ramassage', 'Ramasse', 'En voyage', 'Recu', 'Livraison',
            'Distribution', 'Retourne', 'Livre', 'Reporte', 'Pas de Reponse',
            'Injoignable', 'Hors-Zone', 'Annule', 'Refuse', 'Numero Errone',
            'Deuxieme Appel', 'Programme', 'Boite vocale', 'Client interesse',
            'Expedier vers Centre Retour', 'Recu par Centre Retour',
            'Expedier vers Centre Principale', 'Recu par Centre Principale',
            'Expedier vers Client', 'Recu par Client'
        ];

        foreach ($statuses as $status) {
            Option::factory()->create([
                'code' => $status,
                'nom' => $status
            ]);
        }

    }
}
