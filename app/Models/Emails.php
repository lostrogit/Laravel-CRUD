<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Emails extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'user_id',
        'asunto',
        'destinatario',
        'mensaje',
        'estado',
    ];

    //Columnas que permiten ordenar tabla
    public $sortable = [
        'asunto',
        'destinatario',
        'mensaje',
        'estado',
    ];

    //Relacion de emails con usuarios
    public function usuario()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    // Funcion para obtener estado de emails
    public function obtenerEstado()
    {
        $estado = "ERROR AL ENVIAR";

        if ($this->estado === 1){
            $estado = "POR ENVIAR";
        }elseif($this->estado === 2){
            $estado = "ENVIADO";
        }

        return $estado;
    }
}
