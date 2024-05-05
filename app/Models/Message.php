<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $keyType='string';

    protected $primaryKey = 'id_Mess';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id_Mess','message','id_Rec','id_Ad'];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class);
    }
}
