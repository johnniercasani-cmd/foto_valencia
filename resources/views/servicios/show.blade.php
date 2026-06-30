@extends('layouts.foto')

@section('title', 'Detalle Servicio - Foto Valencia')

@section('content')
    <h1 class="page-title">Detalle del Servicio</h1>

    <div class="card">
        <p><strong>Nombre:</strong> {{ $servicio->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $servicio->descripcion }}</p>
        <p><strong>Precio:</strong> S/ {{ number_format($servicio->precio, 2) }}</p>
        <p><strong>Duración:</strong> {{ $servicio->duracion_minutos }} minutos</p>
        <p><strong>Estado:</strong> {{ $servicio->estado }}</p>
    </div>

    <div class="actions">
        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-yellow">Editar</a>
        <a href="{{ route('servicios.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection