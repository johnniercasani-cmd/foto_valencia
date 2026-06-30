<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'cliente_id',
        'servicio_id',
        'fotografo_id',
        'fecha_reserva',
        'hora_reserva',
        'lugar_sesion',
        'numero_personas',
        'estado_reserva',
        'observaciones',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function fotografo()
    {
        return $this->belongsTo(Fotografo::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function calendarioEvento()
    {
        return $this->hasOne(CalendarioEvento::class);
    }
}