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
}
