<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;
    protected $table = 'villes';
    protected $primaryKey = 'id_V';
    protected $keyType='string';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_V','ref','villename','statut','id_Z'];
    public function zone()
    {
        return $this->belongsTo(Zone::class,'id_Z');
    }
    public function dmc()
    {
        return $this->hasMany(DemandeModificationColi::class,'id_V');
    }
    public function tarifvr()
    {
        return $this->hasMany(Tarif::class,'id_V','villeRamassage');
    }
    public function tarifv()
    {
        return $this->hasMany(Tarif::class,'id_V','ville');
    }
    public function colis()
    {
        return $this->hasMany(Colis::class,'ville_id');
    }
}
