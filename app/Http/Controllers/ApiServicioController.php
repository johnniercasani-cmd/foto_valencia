<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class ApiServicioController extends Controller
{
    public function servicios()
    {
        $servicios = Servicio::where('estado', 'ACTIVO')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($servicio) {
                return [
                    'id' => $servicio->id,
                    'nombre' => $servicio->nombre,
                    'descripcion' => $servicio->descripcion,
                    'precio' => $servicio->precio,
                    'duracion_minutos' => $servicio->duracion_minutos,
                    'imagen' => $this->obtenerImagenServicio($servicio->nombre),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $servicios,
        ]);
    }

    private function obtenerImagenServicio($nombre)
    {
        $nombre = strtolower($nombre);

        if (str_contains($nombre, 'personal')) {
            return asset('img/servicios/sesion-personal.jpg');
        }

        if (str_contains($nombre, 'familiar')) {
            return asset('img/servicios/sesion-familiar.jpg');
        }

        if (str_contains($nombre, 'promoción') || str_contains($nombre, 'promocion')) {
            return asset('img/servicios/cuadro-promocion.jpg');
        }

        if (str_contains($nombre, 'restauración') || str_contains($nombre, 'restauracion')) {
            return asset('img/servicios/restauracion-fotografica.jpg');
        }

        return asset('img/servicios/sesion-personal.jpg');
    }
}