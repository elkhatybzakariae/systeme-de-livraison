<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BonLivraison extends Model
{
    use HasFactory;
    protected $primaryKey='id_BL';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=false;

    protected $fillable = ['id_BL','reference','status','id_Cl'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BL');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
