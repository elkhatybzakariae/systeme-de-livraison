<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;


    protected $primaryKey='id_F';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_F','reference','status','id_Cl','id_Ad'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_F');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
