@extends('layouts.foto')

@section('title', 'Editar Reserva - Foto Valencia')

@section('content')
    <h1 class="page-title">Reprogramar Cita</h1>

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
        <form action="{{ route('reservas.update', $reserva) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; max-width: 900px;">

                @if (!$esCliente)
                    <div class="form-group">
                        <label>Cliente:</label><br>
                        <select name="cliente_id" required>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id', $reserva->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombres }} {{ $cliente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="form-group">
                        <label>Cliente:</label><br>
                        <input type="text"
                               value="{{ $reserva->cliente->nombres }} {{ $reserva->cliente->apellidos }}"
                               disabled>
                    </div>
                @endif

                <div class="form-group">
                    <label>Tipo de servicio:</label><br>
                    <select name="servicio_id" required>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}"
                                {{ old('servicio_id', $reserva->servicio_id) == $servicio->id ? 'selected' : '' }}>
                                {{ $servicio->nombre }} - S/ {{ $servicio->precio }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha:</label><br>
                    <input type="date"
                           name="fecha_reserva"
                           value="{{ old('fecha_reserva', $reserva->fecha_reserva) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Hora:</label><br>
                    <input type="time"
                           name="hora_reserva"
                           value="{{ old('hora_reserva', \Carbon\Carbon::parse($reserva->hora_reserva)->format('H:i')) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Lugar de sesión:</label><br>
                    <input type="text"
                           name="lugar_sesion"
                           value="{{ old('lugar_sesion', $reserva->lugar_sesion) }}">
                </div>

                <div class="form-group">
                    <label>Número de personas:</label><br>
                    <input type="number"
                           name="numero_personas"
                           value="{{ old('numero_personas', $reserva->numero_personas) }}"
                           min="1"
                           required>
                </div>

                @if (!$esCliente)
                    <div class="form-group">
                        <label>Estado:</label><br>
                        <select name="estado_reserva" required>
                            <option value="PENDIENTE" {{ old('estado_reserva', $reserva->estado_reserva) == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                            <option value="CONFIRMADA" {{ old('estado_reserva', $reserva->estado_reserva) == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            <option value="REPROGRAMADA" {{ old('estado_reserva', $reserva->estado_reserva) == 'REPROGRAMADA' ? 'selected' : '' }}>REPROGRAMADA</option>
                            <option value="CANCELADA" {{ old('estado_reserva', $reserva->estado_reserva) == 'CANCELADA' ? 'selected' : '' }}>CANCELADA</option>
                            <option value="FINALIZADA" {{ old('estado_reserva', $reserva->estado_reserva) == 'FINALIZADA' ? 'selected' : '' }}>FINALIZADA</option>
                        </select>
                    </div>
                @else
                    <div class="form-group">
                        <label>Estado:</label><br>
                        <input type="text" value="{{ $reserva->estado_reserva }}" disabled>
                    </div>
                @endif

                <div class="form-group">
                    <label>Observaciones:</label><br>
                    <textarea name="observaciones" rows="3">{{ old('observaciones', $reserva->observaciones) }}</textarea>
                </div>
            </div>

            <br>

            <button type="submit" class="btn btn-blue">Actualizar cita</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection