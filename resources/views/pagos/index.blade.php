@extends('layouts.foto')

@section('title', 'Pagos - Foto Valencia')

@section('content')
    <h1 class="page-title">Pagos Registrados</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn btn-gray">Volver al panel</a>
        <a href="{{ route('pagos.create') }}" class="btn btn-blue">Registrar nuevo pago</a>
        <a href="{{ route('reservas.index') }}" class="btn btn-green">Ver reservas</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Reserva</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Método</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pagos as $pago)
                <tr>
                    <td>Reserva #{{ $pago->reserva->id }}</td>
                    <td>
                        {{ $pago->reserva->cliente->nombres }}
                        {{ $pago->reserva->cliente->apellidos }}
                    </td>
                    <td>S/ {{ number_format($pago->monto, 2) }}</td>
                    <td>{{ $pago->metodo_pago }}</td>
                    <td>{{ $pago->estado_pago }}</td>
                    <td>
                        <a href="{{ route('pagos.show', $pago) }}" class="btn btn-blue">Ver</a>
                        <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-yellow">Editar</a>

                        <form action="{{ route('pagos.destroy', $pago) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar pago?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay pagos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection