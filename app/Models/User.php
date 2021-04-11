<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'celular',
        'cedula',
        'ciudad',
        'fecha_nacimiento',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'datetime',
    ];

    //Relacion con ciudad
    public function obtenerCiudad()
    {
        return $this->hasOne(Ciudad::class,'id', 'ciudad');
    }

    //Funcion para obtener edad
    public function obtenerEdad() {
        return \Carbon\Carbon::parse($this->fecha_nacimiento)->diff(\Carbon\Carbon::now())->format('%y años');;
    }

    //Funcion para dar formato a fecha de nacimiento
    public function obtenerFechaFormateada() {
        if ($this->fecha_nacimiento != '0000-00-00' && $this->fecha_nacimiento != '')
            return $this->asDateTime($this->fecha_nacimiento)->format('Y-m-d');
        else
            return '';
    }

    /**
     * Category HasMany Emails
     */
    //Relación con emails
    public function emails()
    {
        return $this->hasMany('App\Models\Emails');
    }


    //Columnas que permiten ordenar tabla
    public $sortable = [
        'name',
        'cedula',
        'email',
        'fecha_nacimiento',
        'celular',
        'ciudad'
    ];

}
