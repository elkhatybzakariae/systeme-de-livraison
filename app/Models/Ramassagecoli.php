<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramassagecoli extends Model
{
    use HasFactory;
    protected $table = 'ramassagecolis';
    protected $primaryKey = 'id_Ram';
    protected $keyType='string';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Ram','remarque','telephone','adresse','tybe','ville',
    'etat',
    'id_Cl'];
}
