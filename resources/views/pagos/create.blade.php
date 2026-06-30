@extends('layouts.foto')

@section('title', 'Registrar Pago - Foto Valencia')

@section('content')
    <h1 class="page-title">
        {{ Auth::user()->rol && Auth::user()->rol->nombre === 'cliente' ? 'Pagar Reserva' : 'Registrar Pago' }}
    </h1>

    @if ($errors->any())
        <div class="error-box">
            <strong>Revisa los errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('pagos.store') }}" method="POST">
            @csrf

            @if (Auth::user()->rol && Auth::user()->rol->nombre === 'cliente')
                @php
                    $codigoAutomatico = 'OP-' . now('America/Lima')->format('YmdHis') . '-R' . $reserva->id;
                    $fechaAutomatica = now('America/Lima')->format('Y-m-d\TH:i');
                @endphp

                <input type="hidden" name="reserva_id" value="{{ $reserva->id }}">

                <div class="form-group">
                    <label>Reserva:</label><br>
                    <input type="text"
                           value="Reserva #{{ $reserva->id }} - {{ $reserva->servicio->nombre }}"
                           disabled>
                </div>

                <div class="form-group">
                    <label>Cliente:</label><br>
                    <input type="text"
                           value="{{ $reserva->cliente->nombres }} {{ $reserva->cliente->apellidos }}"
                           disabled>
                </div>

                <div class="form-group">
                    <label>Monto:</label><br>
                    <input type="text"
                           value="S/ {{ number_format($reserva->servicio->precio, 2) }}"
                           disabled>
                </div>

                <div class="form-group">
                    <label>Método de pago:</label><br>
                    <select name="metodo_pago" required>
                        <option value="">Seleccione método</option>
                        <option value="Yape" {{ old('metodo_pago') == 'Yape' ? 'selected' : '' }}>Yape</option>
                        <option value="Plin" {{ old('metodo_pago') == 'Plin' ? 'selected' : '' }}>Plin</option>
                        <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                        <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Código de operación:</label><br>
                    <input type="text" value="{{ $codigoAutomatico }}" disabled>
                </div>

                <div class="form-group">
                    <label>Fecha de pago:</label><br>
                    <input type="datetime-local" value="{{ $fechaAutomatica }}" disabled>
                </div>

                <div class="form-group">
                    <label>Estado del pago:</label><br>
                    <input type="text" value="EN VERIFICACIÓN" disabled>
                </div>
            @else
                <div class="form-group">
                    <label>Reserva:</label><br>
                    <select name="reserva_id" required>
                        <option value="">Seleccione una reserva</option>

                        @foreach ($reservas as $item)
                            <option value="{{ $item->id }}"
                                {{ old('reserva_id', isset($reserva) ? $reserva->id : '') == $item->id ? 'selected' : '' }}>
                                Reserva #{{ $item->id }} -
                                {{ $item->cliente->nombres }} {{ $item->cliente->apellidos }} -
                                {{ $item->servicio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Monto:</label><br>
                    <input type="number" name="monto" step="0.01" value="{{ old('monto') }}" required>
                </div>

                <div class="form-group">
                    <label>Método de pago:</label><br>
                    <select name="metodo_pago" required>
                        <option value="">Seleccione método</option>
                        <option value="Yape" {{ old('metodo_pago') == 'Yape' ? 'selected' : '' }}>Yape</option>
                        <option value="Plin" {{ old('metodo_pago') == 'Plin' ? 'selected' : '' }}>Plin</option>
                        <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                        <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Código de operación:</label><br>
                    <input type="text" name="codigo_operacion" value="{{ old('codigo_operacion') }}">
                </div>

                <div class="form-group">
                    <label>Fecha de pago:</label><br>
                    <input type="datetime-local" name="fecha_pago" value="{{ old('fecha_pago') }}">
                </div>

                <div class="form-group">
                    <label>Estado:</label><br>
                    <select name="estado_pago" required>
                        <option value="REGISTRADO">REGISTRADO</option>
                        <option value="EN_VERIFICACION">EN VERIFICACIÓN</option>
                        <option value="RECHAZADO">RECHAZADO</option>
                    </select>
                </div>
            @endif

            <button type="submit" class="btn btn-blue">
                {{ Auth::user()->rol && Auth::user()->rol->nombre === 'cliente' ? 'Enviar pago' : 'Guardar pago' }}
            </button>

            @if (isset($reserva))
                <a href="{{ route('reservas.show', $reserva) }}" class="btn btn-gray">Volver</a>
            @else
                <a href="{{ route('pagos.index') }}" class="btn btn-gray">Volver</a>
            @endif
        </form>
    </div>
@endsection