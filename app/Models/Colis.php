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
    public function bonEnvoi()
    {
        return $this->belongsTo(BonEnvois::class, 'id_BE', 'id_BE');
    }
   
    public function bonDistribution()
    {
        return $this->belongsTo(BonDistribution::class, 'id_BD', 'id_BD');
    }
    public function bonPaymentLivreur()
    {
        return $this->belongsTo(BonPaymentLivreur::class, 'id_BPL', 'id_BPL');
    }
    public function bonPaymentZone()
    {
        return $this->belongsTo(BonPaymentZone::class, 'id_BPZ', 'id_BPZ');
    }
    public function BRZ()
    {
        return $this->belongsTo(BonRetourZone::class, 'id_BRZ');
    }
    public function BRL()
    {
        return $this->belongsTo(BonRetourLivreur::class, 'id_BRL');
    }
    public function BRC()
    {
        return $this->belongsTo(BonRetourClient::class, 'id_BRC');
    }











    public function getColisWithCouleur($status) {
        $option = Option::where('nom',$status); // assuming 'option_id' is stored in 'colis'
    
        return $option;
    }
}
