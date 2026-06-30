@extends('layouts.foto')

@section('title', 'Fotógrafos')

@section('content')
    <h1 class="page-title">Gestión de Fotógrafos</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('fotografos.create') }}" class="btn btn-blue">
            Nuevo fotógrafo
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($fotografos as $fotografo)
                <tr>
                    <td>{{ $fotografo->id }}</td>
                    <td>{{ $fotografo->nombre }}</td>
                    <td>{{ $fotografo->telefono }}</td>
                    <td>{{ $fotografo->correo }}</td>
                    <td>{{ $fotografo->estado }}</td>
                    <td>
                        <a href="{{ route('fotografos.show', $fotografo) }}" class="btn btn-gray">Ver</a>
                        <a href="{{ route('fotografos.edit', $fotografo) }}" class="btn btn-yellow">Editar</a>

                        <form action="{{ route('fotografos.destroy', $fotografo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red"
                                onclick="return confirm('¿Seguro que deseas eliminar este fotógrafo?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay fotógrafos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection