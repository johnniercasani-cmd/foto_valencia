<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'reserva_id',
        'monto',
        'metodo_pago',
        'codigo_operacion',
        'estado_pago',
        'fecha_pago',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}