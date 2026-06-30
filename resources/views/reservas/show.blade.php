@extends('layouts.foto')

@section('title', 'Detalle Reserva - Foto Valencia')

@section('content')
    <h1 class="page-title">Detalle de la Cita</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p><strong>Cliente:</strong> {{ $reserva->cliente->nombres }} {{ $reserva->cliente->apellidos }}</p>
        <p><strong>Servicio:</strong> {{ $reserva->servicio->nombre }}</p>
        <p><strong>Fotógrafo asignado:</strong> {{ $reserva->fotografo->nombre ?? 'Sin asignar' }}</p>
        <p><strong>Fecha:</strong> {{ $reserva->fecha_reserva }}</p>
        <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($reserva->hora_reserva)->format('H:i') }}</p>
        <p><strong>Lugar:</strong> {{ $reserva->lugar_sesion }}</p>
        <p><strong>Número de personas:</strong> {{ $reserva->numero_personas }}</p>
        <p><strong>Estado:</strong> {{ $reserva->estado_reserva }}</p>
        <p>
            <strong>Total pagado registrado:</strong>
            S/ {{ number_format($totalPagado, 2) }}
        </p>
        <p><strong>Observaciones:</strong> {{ $reserva->observaciones }}</p>
    </div>

    <h2 style="font-size: 26px; margin-bottom: 15px;">Pagos registrados</h2>

    @if ($reserva->pagos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Monto</th>
                    <th>Método</th>
                    <th>Código</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reserva->pagos as $pago)
                    <tr>
                        <td>S/ {{ number_format($pago->monto, 2) }}</td>
                        <td>{{ $pago->metodo_pago }}</td>
                        <td>{{ $pago->codigo_operacion }}</td>
                        <td>{{ $pago->estado_pago }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="card">
            <p>Esta reserva aún no tiene pagos registrados.</p>
        </div>
    @endif

    <br>

    <div class="actions">
        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('reservas.pagos.create', $reserva) }}" class="btn btn-green">
                Registrar pago
            </a>
        @endif

        @if (Auth::user()->rol && Auth::user()->rol->nombre === 'cliente')
            <a href="{{ route('reservas.pagos.create', $reserva) }}" class="btn btn-green">
                Pagar reserva
            </a>
        @endif

        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-yellow">Reprogramar</a>
        <a href="{{ route('reservas.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection