<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colisinfo extends Model
{
    use HasFactory;
    protected $table = 'colisinfo';
    protected $primaryKey = 'id_CI';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_CI',
        'info',
        'id',
    ];


    public function colis()
    {
        return $this->belongsTo(Colis::class, 'id');
    }
}
