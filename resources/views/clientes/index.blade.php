@extends('layouts.foto')

@section('title', 'Clientes - Foto Valencia')

@section('content')
    <h1 class="page-title">Clientes Registrados</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn btn-gray">Volver al panel</a>
        <a href="{{ route('clientes.create') }}" class="btn btn-blue">Registrar nuevo cliente</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>
                        <strong>{{ $cliente->nombres }} {{ $cliente->apellidos }}</strong>
                    </td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-blue">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-yellow">Editar</a>

                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar cliente?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection