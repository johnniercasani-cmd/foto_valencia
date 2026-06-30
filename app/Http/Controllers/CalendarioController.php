<?php

namespace App\Http\Controllers;

use App\Models\CalendarioEvento;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index(Request $request)
    {
        $fecha = $request->fecha ?? now('America/Lima')->format('Y-m-d');

        $eventos = CalendarioEvento::with([
                'reserva.cliente',
                'reserva.servicio',
                'reserva.fotografo'
            ])
            ->where('fecha', $fecha)
            ->orderBy('hora_inicio')
            ->get();

        return view('calendario.index', compact('eventos', 'fecha'));
    }
}