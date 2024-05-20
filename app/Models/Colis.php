<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    protected $table = 'colis';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_BL',
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
        'id_BPL',
        'id_BD',
        'id_BE',
        'id_BL',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'id_Cl');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone');
    }
    public function colisinfo()
    {
        return $this->hasOne(colisinfo::class, 'id');
    }
    public function colisModif()
    {
        return $this->hasMany(DemandeModificationColi::class, 'id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'id_BL', 'id_BL');
    }
   
    public function bonDistribution()
    {
        return $this->belongsTo(BonDistribution::class, 'id_BD', 'id_BD');
    }
    public function BRZ()
    {
        return $this->belongsTo(BonRetourZone::class, 'id_BRZ');
    }
}
