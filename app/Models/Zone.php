<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $table = 'zones';
    protected $keyType='string';

    protected $primaryKey = 'id_Z';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Z','zonename','statut'];
    public function dmc()
    {
        return $this->hasMany(DemandeModificationColi::class,'id_Z');
    }
    public function ville()
    {
        return $this->hasMany(Ville::class,'id_Z');
    }
    public function colis()
    {
        return $this->hasMany(Colis::class,'zone');
    }
    public function livreurs()
    {
        return $this->hasMany(Livreur::class,'id_Z');
    }
    public function BOND()
    {
        return $this->hasMany(BonDistribution::class,'id_Z');
    }
    public function BRZ()
    {
        return $this->hasMany(BonRetourZone::class,'id_Z');
    }
}
