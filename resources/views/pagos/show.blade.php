@extends('layouts.foto')

@section('title', 'Detalle Pago - Foto Valencia')

@section('content')
    <h1 class="page-title">Detalle del Pago</h1>

    <div class="card">
        <p><strong>Reserva:</strong> Reserva #{{ $pago->reserva->id }}</p>
        <p>
            <strong>Cliente:</strong>
            {{ $pago->reserva->cliente->nombres }}
            {{ $pago->reserva->cliente->apellidos }}
        </p>
        <p><strong>Servicio:</strong> {{ $pago->reserva->servicio->nombre }}</p>
        <p><strong>Monto:</strong> S/ {{ number_format($pago->monto, 2) }}</p>
        <p><strong>Método de pago:</strong> {{ $pago->metodo_pago }}</p>
        <p><strong>Código:</strong> {{ $pago->codigo_operacion }}</p>
        <p><strong>Estado:</strong> {{ $pago->estado_pago }}</p>
        <p><strong>Fecha de pago:</strong> {{ $pago->fecha_pago }}</p>
    </div>

    <div class="actions">
        <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-yellow">Editar pago</a>
        <a href="{{ route('pagos.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection