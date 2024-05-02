<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_C';

    protected $fillable = [
        'id_C',
            'code_d_envoi',
            'date_d_expedition',
            'destinataire',
            'id_Cl',
            'telephone',
            'marchandise',
            'etat',
            'status',
            'zone',
            'ville_id',
            'prix',
            'quantite',
            'commentaire',
            'adresse',
            'fragile',
            'ouvrir',
            'colis_a_remplacer',
        ];
        

    public function client()
    {
        // return $this->belongsTo(Client::class, 'client_id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
}
