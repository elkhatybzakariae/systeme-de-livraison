<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $primaryKey = 'id_Op';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_Op',
        'code',
        'nom',
        'couleur',
    ];

}
