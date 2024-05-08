<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonEnvois extends Model
{
    use HasFactory;
    protected $primaryKey='id_BE';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_BE','reference','status','id_Liv'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BE');
    }
    // public function client()
    // {
    //     return $this->belongsTo(Client::class,'id_Cl');
    // }

}
