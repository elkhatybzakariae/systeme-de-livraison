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


    public function villeR()
    {
        return $this->belongsTo(Ville::class,'id_V','villeRamassage');
    }
    public function villle()
    {
        return $this->belongsTo(Ville::class, 'ville', 'id_V');
    }
    public function villleRamassage()
    {
        return $this->belongsTo(Ville::class,'villeRamassage','id_V');

    }
}
