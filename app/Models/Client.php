<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id_Cl';
    public $incrementing = false;
    protected $keyType='string';

    public $timestamps = true;
    protected $fillable = ['id_Cl','nommagasin','nomcomplet','typeentreprise','cin','email','Phone'
    ,'ville','villeRamassage','adress','siteweb','nombanque','numerocompte','isActive','isAdmin','acceptedBy','user','valider','password'];
    public function Cville()
    {
        return $this->belongsTo(Ville::class,'ville');
    }
    public function produit()
    {
        return $this->hasMany(Produit::class,'id_Pro');
    }
    public function reclamation()
    {
        return $this->hasMany(Reclamation::class,'id_Cl');
    }
    public function ramassage()
    {
        return $this->hasMany(Ramassagecoli::class,'id_Cl');
    }
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_Cl');
    }
    public function bonLivraison()
    {
        return $this->hasMany(BonLivraison::class,'id_Cl');
    }
    public function acceptedByA()
    {
        return $this->belongsTo(Admin::class,'acceptedBy');
    }
}
