<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonPaymentZone extends Model
{
    use HasFactory;
    protected $table = 'bon_payment_zones';
    protected $primaryKey='id_BPZ';
    public $incrementing=false;
    protected $keyType='string';
    public $timestamps=true;

    protected $fillable = ['id_BPZ','reference','status','id_Z'];
    public function colis()
    {
        return $this->hasMany(Colis::class,'id_BPZ');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class,'id_Z');
    }
}
