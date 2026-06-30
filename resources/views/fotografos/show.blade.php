@extends('layouts.foto')

@section('title', 'Detalle del Fotógrafo')

@section('content')
    <h1 class="page-title">Detalle del Fotógrafo</h1>

    <div class="card">
        <p><strong>ID:</strong> {{ $fotografo->id }}</p>
        <p><strong>Nombre:</strong> {{ $fotografo->nombre }}</p>
        <p><strong>Teléfono:</strong> {{ $fotografo->telefono ?? 'No registrado' }}</p>
        <p><strong>Correo:</strong> {{ $fotografo->correo ?? 'No registrado' }}</p>
        <p><strong>Estado:</strong> {{ $fotografo->estado }}</p>
    </div>

    <div class="card">
        <h2>Reservas asignadas</h2>

        <table>
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($fotografo->reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>
                            {{ $reserva->cliente->nombres ?? 'Sin cliente' }}
                            {{ $reserva->cliente->apellidos ?? '' }}
                        </td>
                        <td>{{ $reserva->servicio->nombre ?? 'Sin servicio' }}</td>
                        <td>{{ $reserva->fecha_reserva }}</td>
                        <td>{{ substr($reserva->hora_reserva, 0, 5) }}</td>
                        <td>{{ $reserva->estado_reserva }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Este fotógrafo aún no tiene reservas asignadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="actions">
        <a href="{{ route('fotografos.edit', $fotografo) }}" class="btn btn-yellow">Editar</a>
        <a href="{{ route('fotografos.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection