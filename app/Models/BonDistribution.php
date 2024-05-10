<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonDistribution extends Model
{
    use HasFactory;
    protected $primaryKey='id_BD';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_BD','reference','status','id_Liv','id_Z'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BD');
    }

}
