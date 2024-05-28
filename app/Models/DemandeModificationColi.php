<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeModificationColi extends Model
{
    use HasFactory;
    protected $table = 'demande_modification_colis';
    protected $keyType = 'string';
    protected $primaryKey = 'id_DMC';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id_DMC',
        'destinataire',
        'telephone',
        'marchandise',
        'zone',
        'ville_id',
        'isAccepted',
        'prix',
        'quantite',
        'commentaire',
        'adresse',
        'id',
    ];


    public function colis()
    {
        return $this->belongsTo(Colis::class, 'id');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone');
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    
}
