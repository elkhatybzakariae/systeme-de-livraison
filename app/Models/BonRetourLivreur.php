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
    public $timestamps=false;

    protected $fillable = ['id_BRL','reference','status','id_Cl'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BRL');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
