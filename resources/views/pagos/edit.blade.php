@extends('layouts.foto')

@section('title', 'Editar Pago - Foto Valencia')

@section('content')
    <h1 class="page-title">Editar Pago</h1>

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
        <form action="{{ route('pagos.update', $pago) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Reserva:</label><br>
                <select name="reserva_id" required>
                    @foreach ($reservas as $reserva)
                        <option value="{{ $reserva->id }}"
                            {{ old('reserva_id', $pago->reserva_id) == $reserva->id ? 'selected' : '' }}>
                            Reserva #{{ $reserva->id }} -
                            {{ $reserva->cliente->nombres }} {{ $reserva->cliente->apellidos }} -
                            {{ $reserva->servicio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Monto:</label><br>
                <input type="number" name="monto" step="0.01" value="{{ old('monto', $pago->monto) }}" required>
            </div>

            <div class="form-group">
                <label>Método de pago:</label><br>
                <select name="metodo_pago" required>
                    <option value="Yape" {{ old('metodo_pago', $pago->metodo_pago) == 'Yape' ? 'selected' : '' }}>Yape</option>
                    <option value="Plin" {{ old('metodo_pago', $pago->metodo_pago) == 'Plin' ? 'selected' : '' }}>Plin</option>
                    <option value="Efectivo" {{ old('metodo_pago', $pago->metodo_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    <option value="Transferencia" {{ old('metodo_pago', $pago->metodo_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                    <option value="Tarjeta" {{ old('metodo_pago', $pago->metodo_pago) == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                </select>
            </div>

            <div class="form-group">
                <label>Código de operación:</label><br>
                <input type="text" name="codigo_operacion" value="{{ old('codigo_operacion', $pago->codigo_operacion) }}">
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado_pago" required>
                    <option value="REGISTRADO" {{ old('estado_pago', $pago->estado_pago) == 'REGISTRADO' ? 'selected' : '' }}>REGISTRADO</option>
                    <option value="EN_VERIFICACION" {{ old('estado_pago', $pago->estado_pago) == 'EN_VERIFICACION' ? 'selected' : '' }}>EN VERIFICACIÓN</option>
                    <option value="RECHAZADO" {{ old('estado_pago', $pago->estado_pago) == 'RECHAZADO' ? 'selected' : '' }}>RECHAZADO</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de pago:</label><br>
                <input type="datetime-local" name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago ? date('Y-m-d\TH:i', strtotime($pago->fecha_pago)) : '') }}">
            </div>

            <button type="submit" class="btn btn-blue">Actualizar pago</button>
            <a href="{{ route('pagos.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection