<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $table = 'depenses';
    protected $primaryKey = 'id_Dep';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Dep','depense','description','montant','datedep','id_Ad'];
    public function user()
    {
        return $this->belongsTo(User::class,'id_U');
    }
}
