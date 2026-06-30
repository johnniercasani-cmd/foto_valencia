<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'user_id',
        'nombres',
        'apellidos',
        'telefono',
        'correo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}