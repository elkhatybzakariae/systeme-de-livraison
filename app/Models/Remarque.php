<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarque extends Model
{
    use HasFactory;
    protected $table = 'remarques';
    protected $primaryKey = 'id_Rem';
    protected $keyType='string';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Rem','objet','etat',
    'id_Ad',
    'id_Cl'];

    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
}
