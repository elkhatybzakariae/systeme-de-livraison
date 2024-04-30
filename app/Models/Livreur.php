<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;
    protected $table = 'livreurs';
    protected $primaryKey = 'id_Liv';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Liv','nomcomplet','cin','email','Phone','ville','adress'
    ,'fraislivraison','fraisrefus','nombanque','numerocompte','password','cinrecto','cinverso','RIB'];
}
