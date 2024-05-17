<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;
    protected $table = 'etat';
    protected $primaryKey = 'id_Et';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_Et',
        'code',
        'nom',
        'couleur',
    ];

}
