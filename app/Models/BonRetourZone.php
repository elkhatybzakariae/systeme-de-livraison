<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonRetourZone extends Model
{
    use HasFactory;
    protected $primaryKey='id_BRZ';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_BRZ','reference','status','id_Cl'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BRZ');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
