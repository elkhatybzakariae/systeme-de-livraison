<?php

namespace App\Imports;

use App\Models\Colis;
use App\Models\colisinfo;
use App\Models\Ville;
use App\Models\Zone;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class ColisImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) 
        {
            // Skip the header row
            if ($index === 0) {
                continue;
            }

            $colis = Colis::create([
                'id' => Str::uuid()->toString(),
                'code_d_envoi' => $row[0],
                'destinataire' => $row[1],
                'telephone' => $row[2],
                'adresse' => $row[3],
                'prix' => $row[4],
                'ville_id' => $this->getVilleIdByName($row[5]),  // You need a method to get the city ID from the name
                'commentaire' => $row[6],
                'marchandise' => $row[7],
                'id_Cl'=>session('user')['id_Cl'],
                'zone'=>Zone::query()->first()->id_Z,
                'quantite' => $this->getQuantiteFromProduct($row[7]),  // Assuming the format of PRODUCT:QTE
            ]);

            colisinfo::create([
                'info' => 'Additional info', // Adjust this as per your need
                'id' => $colis->id,
            ]);
        }
    }

    /**
     * Get ville_id from the city name
     */
    private function getVilleIdByName($name)
    {
        return Ville::where('villename', $name)->first()->id_V;
        // return 1; // Placeholder
    }

    /**
     * Extract quantity from product:quantity format
     */
    private function getQuantiteFromProduct($product)
    {
        // Assuming the format is PRODUCT:QTE
        $parts = explode(':', $product);
        return isset($parts[1]) ? (int)$parts[1] : 1;
    }
}
