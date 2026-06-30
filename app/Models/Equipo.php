<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'nombre_equipo',
        'tipo_equipo',
        'estado_equipo',
        'fecha_mantenimiento',
        'observaciones',
    ];
}