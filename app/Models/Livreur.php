<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Livreur extends Authenticatable
{
    use HasFactory;
    protected $table = 'livreurs';
    protected $primaryKey = 'id_Liv';
    protected $keyType='string';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Liv','nomcomplet','cin','email','Phone','ville','adress'
    ,'fraislivraison','fraisrefus','nombanque','numerocompte','password','cinrecto','cinverso','RIB'];
}
