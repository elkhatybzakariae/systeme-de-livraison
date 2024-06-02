<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    use HasFactory;
    protected $table = 'frais';
    protected $keyType = 'string';
    protected $primaryKey = 'id_Fr';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id_Fr',
        'title',
        'prix',
        'id_F','quntite'
    ];


    public function facture()
    {
        return $this->belongsTo(Facture::class, 'id_F');
    }
}
