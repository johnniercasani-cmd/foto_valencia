<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotografo extends Model
{
    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'estado',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}