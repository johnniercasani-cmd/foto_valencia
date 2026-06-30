@extends('layouts.foto')

@section('title', 'Servicios - Foto Valencia')

@section('content')
    <h1 class="page-title">Servicios Fotográficos</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn btn-gray">Volver al panel</a>
        <a href="{{ route('servicios.create') }}" class="btn btn-blue">Registrar nuevo servicio</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Duración</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($servicios as $servicio)
                <tr>
                    <td>
                        <strong>{{ $servicio->nombre }}</strong><br>
                        {{ $servicio->descripcion }}
                    </td>
                    <td>S/ {{ number_format($servicio->precio, 2) }}</td>
                    <td>{{ $servicio->duracion_minutos }} min</td>
                    <td>{{ $servicio->estado }}</td>
                    <td>
                        <a href="{{ route('servicios.show', $servicio) }}" class="btn btn-blue">Ver</a>
                        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-yellow">Editar</a>

                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar servicio?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay servicios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection