<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonPaymentLivreur extends Model
{
    use HasFactory;
    protected $primaryKey='id_BPL';
    public $incrementing=false;
    protected $keyType='string';
    

    protected $fillable = ['id_BPL','reference','status','id_Z','id_Liv'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BPL');
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class,'id_Liv');
    }
}
