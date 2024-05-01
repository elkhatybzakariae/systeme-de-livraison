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
    ,'nombanque','numerocompte','isAdmin','password'];

}
