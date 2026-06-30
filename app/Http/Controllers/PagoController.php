<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Reserva;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    private function validarAccesoClienteReserva(Reserva $reserva)
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

    public function index()
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            $cliente = Cliente::where('user_id', $usuario->id)->first();

            if (!$cliente) {
                $pagos = collect();
            } else {
                $pagos = Pago::with(['reserva.cliente', 'reserva.servicio'])
                    ->whereHas('reserva', function ($query) use ($cliente) {
                        $query->where('cliente_id', $cliente->id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } else {
            $pagos = Pago::with(['reserva.cliente', 'reserva.servicio'])
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            return redirect()
                ->route('reservas.index')
                ->with('success', 'Selecciona una reserva para realizar el pago.');
        }

        $reservas = Reserva::with(['cliente', 'servicio'])
            ->orderBy('id', 'desc')
            ->get();

        return view('pagos.create', compact('reservas'));
    }

    public function createDesdeReserva(Reserva $reserva)
    {
        $this->validarAccesoClienteReserva($reserva);

        $reserva->load(['cliente', 'servicio']);

        $reservas = Reserva::with(['cliente', 'servicio'])
            ->orderBy('id', 'desc')
            ->get();

        return view('pagos.create', compact('reservas', 'reserva'));
    }

    public function store(Request $request)
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            $request->validate([
                'reserva_id' => 'required|exists:reservas,id',
                'metodo_pago' => 'required|string|max:50',
            ]);

            $cliente = Cliente::where('user_id', $usuario->id)->first();

            $reserva = Reserva::with('servicio')
                ->findOrFail($request->reserva_id);

            if (!$cliente || $reserva->cliente_id !== $cliente->id) {
                abort(403, 'No tienes permiso para pagar esta reserva.');
            }
    
        Pago::create([
            'reserva_id' => $reserva->id,
            'monto' => $reserva->servicio->precio,
            'metodo_pago' => $request->metodo_pago,
            'codigo_operacion' => 'OP-' . now('America/Lima')->format('YmdHis') . '-R' . $reserva->id,
            'estado_pago' => 'EN_VERIFICACION',
            'fecha_pago' => now('America/Lima'),
        ]);
    
        return redirect()
            ->route('reservas.show', $reserva)
            ->with('success', 'Pago enviado correctamente. Queda pendiente de verificación.');
    }

        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'codigo_operacion' => 'nullable|string|max:100',
            'estado_pago' => 'required|string|max:30',
            'fecha_pago' => 'nullable|date',
        ]);

        $pago = Pago::create($request->all());

        if ($pago->estado_pago === 'REGISTRADO') {
            $pago->reserva->update([
                'estado_reserva' => 'CONFIRMADA',
            ]);
        }

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load(['reserva.cliente', 'reserva.servicio']);

        $this->validarAccesoClienteReserva($pago->reserva);

        return view('pagos.show', compact('pago'));
    }

    public function edit(Pago $pago)
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            abort(403, 'El cliente no puede editar pagos.');
        }

        $reservas = Reserva::with(['cliente', 'servicio'])
            ->orderBy('id', 'desc')
            ->get();

        return view('pagos.edit', compact('pago', 'reservas'));
    }

    public function update(Request $request, Pago $pago)
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            abort(403, 'El cliente no puede editar pagos.');
        }

        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'codigo_operacion' => 'nullable|string|max:100',
            'estado_pago' => 'required|string|max:30',
            'fecha_pago' => 'nullable|date',
        ]);

        $pago->update($request->all());

        if ($pago->estado_pago === 'REGISTRADO') {
            $pago->reserva->update([
                'estado_reserva' => 'CONFIRMADA',
            ]);
        }

        if ($pago->estado_pago === 'RECHAZADO') {
            $pago->reserva->update([
                'estado_reserva' => 'PENDIENTE',
            ]);
        }

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago actualizado correctamente. El estado de la reserva fue actualizado.');
    }

    public function destroy(Pago $pago)
    {
        $usuario = auth()->user();
        $rol = $usuario->rol ? $usuario->rol->nombre : null;

        if ($rol === 'cliente') {
            abort(403, 'El cliente no puede eliminar pagos.');
        }   

        $pago->delete();

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago eliminado correctamente.');
    }
}