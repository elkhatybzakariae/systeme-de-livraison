<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;
    protected $table = 'reclamations';
    protected $primaryKey = 'id_Rec';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Rec','objet','etat','id_C','id_Cl'];

    public function client()
    {
        return $this->belongsTo(Client::class,'id_Cl');
    }
    public function message()
    {
        return $this->hasMany(Message::class,'id_Rec');
    }
}
