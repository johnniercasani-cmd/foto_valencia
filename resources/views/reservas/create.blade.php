@extends('layouts.foto')

@section('title', 'Registrar Reserva - Foto Valencia')

@section('content')
    <h1 class="page-title">Separar una Cita</h1>

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

    <div class="card" style="max-width: 900px;">
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; max-width: 900px;">

                @if ($esCliente)
                    <div class="form-group">
                        <label>Nombres:</label><br>
                        <input type="text"
                               name="cliente_nombres"
                               value="{{ old('cliente_nombres', $clienteActual->nombres ?? Auth::user()->name) }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Apellidos:</label><br>
                        <input type="text"
                               name="cliente_apellidos"
                               value="{{ old('cliente_apellidos', $clienteActual->apellidos ?? '') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Teléfono:</label><br>
                        <input type="text"
                               name="cliente_telefono"
                               value="{{ old('cliente_telefono', $clienteActual->telefono ?? Auth::user()->telefono) }}">
                    </div>

                    <div class="form-group">
                        <label>Correo:</label><br>
                        <input type="email"
                               name="cliente_correo"
                               value="{{ old('cliente_correo', $clienteActual->correo ?? Auth::user()->email) }}"
                               required>
                    </div>
                @else
                    <div class="form-group">
                        <label>Cliente:</label><br>
                        <select name="cliente_id" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombres }} {{ $cliente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label>Tipo de servicio:</label><br>
                    <select name="servicio_id" required>
                        <option value="">Seleccione un servicio</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}>
                                {{ $servicio->nombre }} - S/ {{ $servicio->precio }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha:</label><br>
                    <input type="date" name="fecha_reserva" value="{{ old('fecha_reserva') }}" required>
                </div>

                <div class="form-group">
                    <label>Hora disponible:</label><br>
                    <select name="hora_reserva" id="hora_reserva" required>
                        <option value="">Primero seleccione servicio y fecha</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Lugar de sesión:</label><br>
                    <input type="text" name="lugar_sesion" value="{{ old('lugar_sesion', 'Estudio Foto Valencia') }}">
                </div>

                <div class="form-group">
                    <label>Número de personas:</label><br>
                    <input type="number" name="numero_personas" value="{{ old('numero_personas', 1) }}" min="1" required>
                </div>

                @if (!$esCliente)
                    <div class="form-group">
                        <label>Estado:</label><br>
                        <select name="estado_reserva" required>
                            <option value="PENDIENTE" {{ old('estado_reserva') == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                            <option value="CONFIRMADA" {{ old('estado_reserva') == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            <option value="REPROGRAMADA" {{ old('estado_reserva') == 'REPROGRAMADA' ? 'selected' : '' }}>REPROGRAMADA</option>
                            <option value="CANCELADA" {{ old('estado_reserva') == 'CANCELADA' ? 'selected' : '' }}>CANCELADA</option>
                            <option value="FINALIZADA" {{ old('estado_reserva') == 'FINALIZADA' ? 'selected' : '' }}>FINALIZADA</option>
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label>Observaciones:</label><br>
                    <textarea name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                </div>
            </div>

            <br>

            <button type="submit" class="btn btn-blue">Separar ahora</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const servicioSelect = document.querySelector('select[name="servicio_id"]');
            const fechaInput = document.querySelector('input[name="fecha_reserva"]');
            const horaSelect = document.getElementById('hora_reserva');

            function cargarHorarios() {
                const servicioId = servicioSelect.value;
                const fecha = fechaInput.value;

                horaSelect.innerHTML = '<option value="">Cargando horarios...</option>';

                if (!servicioId || !fecha) {
                    horaSelect.innerHTML = '<option value="">Primero seleccione servicio y fecha</option>';
                    return;
                }

                fetch(`/api/horarios-disponibles?servicio_id=${servicioId}&fecha=${fecha}`)
                    .then(response => response.json())
                    .then(resultado => {
                        horaSelect.innerHTML = '';

                        if (!resultado.success || resultado.data.length === 0) {
                            horaSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                            return;
                        }

                        horaSelect.innerHTML = '<option value="">Seleccione un horario</option>';

                        resultado.data.forEach(horario => {
                            const option = document.createElement('option');
                            option.value = horario.hora;
                            option.textContent = horario.texto;
                            horaSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        horaSelect.innerHTML = '<option value="">Error al cargar horarios</option>';
                    });
            }

            servicioSelect.addEventListener('change', cargarHorarios);
            fechaInput.addEventListener('change', cargarHorarios);
        });
    </script>
@endsection