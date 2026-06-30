@extends('layouts.foto')

@section('title', 'Detalle Cliente - Foto Valencia')

@section('content')
    <h1 class="page-title">Detalle del Cliente</h1>

    <div class="card">
        <p><strong>Nombres:</strong> {{ $cliente->nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
    </div>

    <div class="actions">
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-yellow">Editar</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-gray">Volver</a>
    </div>
@endsection