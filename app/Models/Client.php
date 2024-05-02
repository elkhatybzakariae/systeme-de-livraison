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
    public $timestamps = true;
    protected $fillable = ['id_Cl','nommagasin','nomcomplet','typeentreprise','cin','email','Phone'
    ,'ville','villeRamassage','adress','siteweb','nombanque','numerocompte','isAdmin','password'];
    public function produit()
    {
        return $this->hasMany(Produit::class,'id_Pro');
    }
}
