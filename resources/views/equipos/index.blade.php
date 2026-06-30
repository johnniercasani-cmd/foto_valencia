@extends('layouts.foto')

@section('title', 'Inventario - Foto Valencia')

@section('content')
    <h1 class="page-title">Inventario de Equipos</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn btn-gray">Volver al panel</a>
        <a href="{{ route('equipos.create') }}" class="btn btn-blue">Registrar nuevo equipo</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Mantenimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($equipos as $equipo)
                <tr>
                    <td>
                        <strong>{{ $equipo->nombre_equipo }}</strong><br>
                        {{ $equipo->observaciones }}
                    </td>
                    <td>{{ $equipo->tipo_equipo }}</td>
                    <td>{{ $equipo->estado_equipo }}</td>
                    <td>{{ $equipo->fecha_mantenimiento }}</td>
                    <td>
                        <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-blue">Ver</a>
                        <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-yellow">Editar</a>

                        <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar equipo?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay equipos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection