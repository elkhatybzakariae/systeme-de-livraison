<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarque extends Model
{
    use HasFactory;
    protected $table = 'remarques';
    protected $primaryKey = 'id_Rem';
    protected $keyType='string';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Rem','remarque','type',
    'cible',
    'section',
    'id_Ad'];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'id_Ad');
    }
}
