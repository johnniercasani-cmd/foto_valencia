@extends('layouts.foto')

@section('title', 'Detalle Equipo - Foto Valencia')

@section('content')
    <h1 class="page-title">Detalle del Equipo</h1>

    <div class="card">
        <p><strong>Nombre:</strong> {{ $equipo->nombre_equipo }}</p>
        <p><strong>Tipo:</strong> {{ $equipo->tipo_equipo }}</p>
        <p><strong>Estado:</strong> {{ $equipo->estado_equipo }}</p>
        <p><strong>Fecha de mantenimiento:</strong> {{ $equipo->fecha_mantenimiento }}</p>
        <p><strong>Observaciones:</strong> {{ $equipo->observaciones }}</p>
    </div>

    <div class="actions">
        <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-yellow">Editar</a>
        <a href="{{ route('equipos.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection