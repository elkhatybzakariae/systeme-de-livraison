<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;
    protected $table = 'villes';
    protected $primaryKey = 'id_V';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_V','ref','villename','statut','id_Z'];
    public function zone()
    {
        return $this->belongsTo(Zone::class,'id_Z');
    }
    public function tarifvr()
    {
        return $this->hasMany(Tarif::class,'id_V','villeRamassage');
    }
    public function tarifv()
    {
        return $this->hasMany(Tarif::class,'id_V','ville');
    }
}
