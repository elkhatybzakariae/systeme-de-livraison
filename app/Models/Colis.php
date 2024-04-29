<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_C';

    protected $fillable = [
        'code_d_envoi',
        'date_d_expedition',
        'etat',
        'status',
        'ville_id',
        'prix',
    ];

    public function client()
    {
        // return $this->belongsTo(Client::class, 'client_id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
}
