<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $table = 'zones';
    protected $keyType='string';

    protected $primaryKey = 'id_Z';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Z','zonename','statut'];
    public function ville()
    {
        return $this->hasMany(Ville::class,'id_Z');
    }
    public function colis()
    {
        return $this->hasMany(Colis::class,'zone');
    }
}
