@extends('layouts.foto')

@section('title', 'Reservas - Foto Valencia')

@section('content')
    <h1 class="page-title">Historial de Citas</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn btn-gray">Volver al panel</a>
        <a href="{{ route('reservas.create') }}" class="btn btn-blue">Registrar nueva reserva</a>

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('pagos.index') }}" class="btn btn-green">Ver pagos</a>
        @endif
    </div>

    @forelse ($reservas as $reserva)
        <div class="card">
            <table style="background: transparent;">
                <tr>
                    <th>Cita</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>

                <tr>
                    <td>
                        <strong>{{ $reserva->servicio->nombre }}</strong><br>
                        {{ $reserva->cliente->nombres }} {{ $reserva->cliente->apellidos }}
                    </td>

                    <td>{{ $reserva->fecha_reserva }}</td>

                    <td>{{ \Carbon\Carbon::parse($reserva->hora_reserva)->format('H:i') }}</td>

                    <td>
                        <strong>{{ $reserva->estado_reserva }}</strong>
                    </td>

                    <td>
                        <a href="{{ route('reservas.show', $reserva) }}" class="btn btn-blue">
                            Más detalles
                        </a>

                        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-yellow">
                            Reprogramar
                        </a>

                        <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar reserva?')">
                                Cancelar
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    @empty
        <div class="card">
            <p>No hay reservas registradas.</p>
        </div>
    @endforelse
@endsection