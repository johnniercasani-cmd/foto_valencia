<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ventas()
    {
        $ventas = DB::table('vista_reporte_ventas')
            ->orderBy('fecha_pago', 'desc')
            ->get();

        $totalVentas = $ventas
            ->where('estado_pago', 'REGISTRADO')
            ->sum('monto_pagado');

        $cantidadPagos = $ventas->count();

        $pagosRegistrados = $ventas
            ->where('estado_pago', 'REGISTRADO')
            ->count();

        $pagosPendientes = $ventas
            ->where('estado_pago', 'EN_VERIFICACION')
            ->count();

        return view('reportes.ventas', compact(
            'ventas',
            'totalVentas',
            'cantidadPagos',
            'pagosRegistrados',
            'pagosPendientes'
        ));
    }
}