<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Fotografo;
use App\Models\CalendarioEvento;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    private function validarAccesoCliente(Reserva $reserva)
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            $cliente = Cliente::where('user_id', $usuario->id)->first();

            if (!$cliente || $reserva->cliente_id !== $cliente->id) {
                abort(403, 'No tienes permiso para acceder a esta reserva.');
            }
        }
    }


    private function obtenerFotografoDisponible($fecha, $horaInicio, $horaFin, $reservaIgnoradaId = null)
    {
        $eventosOcupados = CalendarioEvento::with('reserva')
            ->where('fecha', $fecha)
            ->where('disponibilidad', 'OCUPADO')
            ->where('hora_inicio', '<', $horaFin)
            ->where('hora_fin', '>', $horaInicio)
            ->whereHas('reserva', function ($query) use ($reservaIgnoradaId) {
                $query->whereIn('estado_reserva', ['PENDIENTE', 'CONFIRMADA', 'REPROGRAMADA']);

                if ($reservaIgnoradaId) {
                    $query->where('id', '!=', $reservaIgnoradaId);
                }
            })
            ->get();

        $fotografosOcupados = $eventosOcupados
            ->pluck('reserva.fotografo_id')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        return Fotografo::where('estado', 'ACTIVO')
            ->whereNotIn('id', $fotografosOcupados)
            ->first();
    }

    public function horariosDisponibles(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
        ]);

        $servicio = Servicio::findOrFail($request->servicio_id);

        $horaApertura = Carbon::parse('09:00');
        $horaCierre = Carbon::parse('18:00');
        $duracion = $servicio->duracion_minutos;

        $horarios = [];

        while ($horaApertura->copy()->addMinutes($duracion)->lte($horaCierre)) {
            $inicio = $horaApertura->format('H:i:s');
            $fin = $horaApertura->copy()->addMinutes($duracion)->format('H:i:s');

            $fotografoDisponible = $this->obtenerFotografoDisponible(
                $request->fecha,
                $inicio,
                $fin
            );

            if ($fotografoDisponible) {
                $horarios[] = [
                    'hora' => $horaApertura->format('H:i'),
                    'texto' => $horaApertura->format('H:i') . ' - ' . $horaApertura->copy()->addMinutes($duracion)->format('H:i'),
                ];
            }

            $horaApertura->addMinutes($duracion);
        }

        return response()->json([
            'success' => true,
            'data' => $horarios,
        ]);
    }


    public function index()
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            $cliente = Cliente::where('user_id', $usuario->id)->first();

            if (!$cliente) {
                $reservas = collect();
            } else {
                $reservas = Reserva::with(['cliente', 'servicio'])
                    ->where('cliente_id', $cliente->id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } else {
            $reservas = Reserva::with(['cliente', 'servicio'])
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('reservas.index', compact('reservas'));
    }



    public function create()
    {
        $usuario = auth()->user();
        $esCliente = $usuario->rol && $usuario->rol->nombre === 'cliente';

        $clientes = Cliente::orderBy('nombres')->get();

        $clienteActual = null;

        if ($esCliente) {
            $clienteActual = Cliente::where('user_id', $usuario->id)->first();
        }

        $servicios = Servicio::where('estado', 'ACTIVO')
            ->orderBy('nombre')
            ->get();

        return view('reservas.create', compact('clientes', 'servicios', 'esCliente', 'clienteActual'));
    }



    public function store(Request $request)
    {
        $usuario = auth()->user();
        $esCliente = $usuario->rol && $usuario->rol->nombre === 'cliente';

        if ($esCliente) {
            $request->validate([
                'cliente_nombres' => 'required|string|max:100',
                'cliente_apellidos' => 'required|string|max:100',
                'cliente_telefono' => 'nullable|string|max:20',
                'cliente_correo' => 'required|email|max:100',
                'servicio_id' => 'required|exists:servicios,id',
                'fecha_reserva' => 'required|date',
                'hora_reserva' => 'required',
                'lugar_sesion' => 'nullable|string|max:150',
                'numero_personas' => 'required|integer|min:1',
                'observaciones' => 'nullable|string',
            ]);

            $cliente = Cliente::updateOrCreate(
                ['user_id' => $usuario->id],
                [
                    'nombres' => $request->cliente_nombres,
                    'apellidos' => $request->cliente_apellidos,
                    'telefono' => $request->cliente_telefono,
                    'correo' => $request->cliente_correo,
                ]
            );

            $clienteId = $cliente->id;
            $estadoReserva = 'PENDIENTE';
        } else {
            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'servicio_id' => 'required|exists:servicios,id',
                'fecha_reserva' => 'required|date',
                'hora_reserva' => 'required',
                'lugar_sesion' => 'nullable|string|max:150',
                'numero_personas' => 'required|integer|min:1',
                'estado_reserva' => 'required|string|max:30',
                'observaciones' => 'nullable|string',
            ]);

            $clienteId = $request->cliente_id;
            $estadoReserva = $request->estado_reserva;
        }

        $servicio = Servicio::findOrFail($request->servicio_id);

        $horaReserva = Carbon::parse($request->hora_reserva)->format('H:i:s');

        $horaFin = Carbon::parse($horaReserva)
            ->addMinutes($servicio->duracion_minutos)
            ->format('H:i:s');

        $fotografoDisponible = $this->obtenerFotografoDisponible(
            $request->fecha_reserva,
            $horaReserva,
            $horaFin
        );

        if (!$fotografoDisponible) {
            return back()
                ->withErrors(['hora_reserva' => 'No hay fotógrafos disponibles para ese horario.'])
                ->withInput();
        }

        $reserva = Reserva::create([
            'cliente_id' => $clienteId,
            'servicio_id' => $request->servicio_id,
            'fotografo_id' => $fotografoDisponible->id,
            'fecha_reserva' => $request->fecha_reserva,
            'hora_reserva' => $horaReserva,
            'lugar_sesion' => $request->lugar_sesion,
            'numero_personas' => $request->numero_personas,
            'estado_reserva' => $estadoReserva,
            'observaciones' => $request->observaciones,
        ]);

        CalendarioEvento::create([
            'reserva_id' => $reserva->id,
            'fecha' => $request->fecha_reserva,
            'hora_inicio' => $horaReserva,
            'hora_fin' => $horaFin,
            'disponibilidad' => 'OCUPADO',
        ]);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva registrada correctamente.');
    }



    public function show(Reserva $reserva)
    {
        $this->validarAccesoCliente($reserva);
    
        $reserva->load(['cliente', 'servicio', 'fotografo', 'pagos', 'calendarioEvento']);
    
        $resultado = DB::select(
            'SELECT fn_total_pagado_reserva(?) AS total_pagado',
            [$reserva->id]
        );
    
        $totalPagado = $resultado[0]->total_pagado ?? 0;
    
        return view('reservas.show', compact('reserva', 'totalPagado'));
    }



    public function edit(Reserva $reserva)
    {
        $this->validarAccesoCliente($reserva);

        $usuario = auth()->user();
        $esCliente = $usuario->rol && $usuario->rol->nombre === 'cliente';

        $clientes = Cliente::orderBy('nombres')->get();

        $servicios = Servicio::where('estado', 'ACTIVO')
            ->orderBy('nombre')
            ->get();

        return view('reservas.edit', compact('reserva', 'clientes', 'servicios', 'esCliente'));
    }



    public function update(Request $request, Reserva $reserva)
    {
        $this->validarAccesoCliente($reserva);
    
        $usuario = auth()->user();
        $esCliente = $usuario->rol && $usuario->rol->nombre === 'cliente';
    
        if ($esCliente) {
            $request->validate([
                'servicio_id' => 'required|exists:servicios,id',
                'fecha_reserva' => 'required|date',
                'hora_reserva' => 'required',
                'lugar_sesion' => 'nullable|string|max:150',
                'numero_personas' => 'required|integer|min:1',
                'observaciones' => 'nullable|string',
            ]);
    
            $clienteId = $reserva->cliente_id;
            $estadoReserva = 'REPROGRAMADA';
        } else {
            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'servicio_id' => 'required|exists:servicios,id',
                'fecha_reserva' => 'required|date',
                'hora_reserva' => 'required',
                'lugar_sesion' => 'nullable|string|max:150',
                'numero_personas' => 'required|integer|min:1',
                'estado_reserva' => 'required|string|max:30',
                'observaciones' => 'nullable|string',
            ]);
    
            $clienteId = $request->cliente_id;
            $estadoReserva = $request->estado_reserva;
        }
    
        $horaReserva = Carbon::parse($request->hora_reserva)->format('H:i:s');
    
        $existeReserva = Reserva::where('fecha_reserva', $request->fecha_reserva)
            ->where('hora_reserva', $horaReserva)
            ->whereIn('estado_reserva', ['PENDIENTE', 'CONFIRMADA', 'REPROGRAMADA'])
            ->where('id', '!=', $reserva->id)
            ->exists();
    
        if ($existeReserva) {
            return back()
                ->withErrors(['hora_reserva' => 'Ya existe otra reserva activa en esa fecha y hora.'])
                ->withInput();
        }
    
        $reserva->update([
            'cliente_id' => $clienteId,
            'servicio_id' => $request->servicio_id,
            'fecha_reserva' => $request->fecha_reserva,
            'hora_reserva' => $horaReserva,
            'lugar_sesion' => $request->lugar_sesion,
            'numero_personas' => $request->numero_personas,
            'estado_reserva' => $estadoReserva,
            'observaciones' => $request->observaciones,
        ]);
    
        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }



    public function destroy(Reserva $reserva)
    {
        $this->validarAccesoCliente($reserva);
    
        $reserva->delete();
    
        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }
}