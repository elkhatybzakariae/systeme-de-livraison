<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonRetourLivreur extends Model
{
    use HasFactory;
    protected $primaryKey='id_BRL';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_BRL','reference','status','id_Liv'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BRL');
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class,'id_Liv');
    }
}
