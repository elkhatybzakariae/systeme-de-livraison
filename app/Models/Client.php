<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id_Cl';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Cl','nommagasin','nomcomplet','typeentreprise','cin','email','Phone'
    ,'ville','villeRamassage','adress','siteweb','nombanque','numerocompte','isAdmin','password'];
}
