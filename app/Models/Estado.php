<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    use HasFactory;

    //Relación con Paises
    public function obtenerPais()
    {
        return $this->hasOne(Pais::class,'id', 'country_id');
    }
}
