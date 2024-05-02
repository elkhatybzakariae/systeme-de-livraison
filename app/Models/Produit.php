<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';
    protected $primaryKey = 'id_Pro';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Pro','imgpro','nompro','refpro','quantitie','description','id_Cl'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
