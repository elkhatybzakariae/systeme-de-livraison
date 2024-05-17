<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeClient extends Model
{
    use HasFactory;
    protected $table = 'typeclients';
    protected $primaryKey = 'id_TC';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_TC',
        'nom',
    ];

}
