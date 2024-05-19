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

    protected $fillable = ['id_BRZ','reference','id_Z','status'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BRZ');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class,'id_Z');
    }
}
