<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;
    // protected $primaryKey='id_BL';
    protected $fillable = ['id_BL','reference','status','id_Cl'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BL');
    }
}
