<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudad';
    use HasFactory;

    //Relación con estados
    public function obtenerEstado()
    {
        return $this->hasOne(Estado::class,'id', 'state_id');
    }
}
