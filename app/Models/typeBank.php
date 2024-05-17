<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeBank extends Model
{
    use HasFactory;
    protected $table = 'typebank';
    protected $primaryKey = 'id_TB';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_TB',
        'nom',
    ];
}
