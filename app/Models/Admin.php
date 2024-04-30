<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $primaryKey = 'id_Ad';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Ad','nommagasin','nomcomplet','email','Phone','ville','adress'
    ,'nombanque','numerocompte','isAdmin','password'];

}
