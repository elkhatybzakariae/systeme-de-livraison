<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarifs';
    protected $primaryKey = 'id_Tar';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Tar','villeRamassage','ville','prixliv','prixret','prixref','delailiv'];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
