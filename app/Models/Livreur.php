<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Livreur extends Authenticatable
{
    use HasFactory;
    protected $table = 'livreurs';
    protected $primaryKey = 'id_Liv';
    protected $keyType='string';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Liv','nomcomplet','cin','email','Phone','ville','adress','id_Z'
    ,'fraislivraison','fraisrefus','nombanque','numerocompte','password','cinrecto','cinverso','RIB'];

    public function zone(){
        return $this->belongsTo(Zone::class,'id_Z');
    }
    public function BD(){
        return $this->hasMany(Livreur::class,'id_Liv');
    }
    public function bonDistributions()
    {
        return $this->hasMany(BonDistribution::class, 'id_Liv', 'id_Liv');
    }
    public function colis()
    {
        return $this->hasManyThrough(Colis::class, BonDistribution::class, 'id_Liv', 'id_BD', 'id_Liv', 'id_BD');
    }

    public function deliveredColisCount()
    {
        return $this->colis()
                    ->where('status', 'Livre')
                    ->where('etat', 'Paye')
                    ->selectRaw('livreurs.id_Liv, COUNT(colis.id) as delivered_colis_count')
                    ->groupBy('livreurs.id_Liv');
    }


}
