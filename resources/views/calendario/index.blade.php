@extends('layouts.foto')

@section('title', 'Calendario de Reservas')

@section('content')
    <div class="page-header">
        <h1>Agenda de Reservas</h1>
        <p>Visualización de eventos registrados en la tabla <strong>calendario_eventos</strong>.</p>
    </div>

    <div class="card">
        <form method="GET" action="{{ route('calendario.index') }}">
            <div class="form-group">
                <label>Seleccionar fecha:</label><br>
                <input type="date" name="fecha" value="{{ $fecha }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h2>Eventos del día {{ $fecha }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Fotógrafo</th>
                    <th>Estado Reserva</th>
                    <th>Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventos as $evento)
                    <tr>
                        <td>
                            {{ substr($evento->hora_inicio, 0, 5) }}
                            -
                            {{ substr($evento->hora_fin, 0, 5) }}
                        </td>

                        <td>
                            {{ $evento->reserva->cliente->nombres ?? 'Sin cliente' }}
                            {{ $evento->reserva->cliente->apellidos ?? '' }}
                        </td>

                        <td>
                            {{ $evento->reserva->servicio->nombre ?? 'Sin servicio' }}
                        </td>

                        <td>
                            {{ $evento->reserva->fotografo->nombre ?? 'Sin fotógrafo' }}
                        </td>

                        <td>
                            {{ $evento->reserva->estado_reserva ?? 'Sin estado' }}
                        </td>

                        <td>
                            {{ $evento->disponibilidad }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay eventos registrados para esta fecha.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection