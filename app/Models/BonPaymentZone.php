<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonPaymentZone extends Model
{
    use HasFactory;
    protected $primaryKey='id_BPZ';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=false;

    protected $fillable = ['id_BPZ','reference','status','id_Cl'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BPZ');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
