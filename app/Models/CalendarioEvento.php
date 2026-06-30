<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarioEvento extends Model
{
    protected $fillable = [
        'reserva_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'disponibilidad',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}