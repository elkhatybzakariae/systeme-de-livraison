<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'id_Ad';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Ad','nommagasin','nomcomplet','email','Phone','ville','adress'
    ,'nombanque','numerocompte','isAdmin','password','cin','role','user','photo','cinrecto','cinverso','RIB'];
    public function remarque()
    {
        return $this->hasMany(Remarque::class);
    }
    public function ClAcc()
    {
        return $this->hasMany(Client::class);
    }


    public function referrer() {
        return $this->belongsTo(Admin::class, 'user');
    }
    public function referrals() {
        return $this->hasMany(Admin::class,'user');
    }
}
