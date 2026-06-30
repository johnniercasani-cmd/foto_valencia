@extends('layouts.foto')

@section('title', 'Editar Cliente - Foto Valencia')

@section('content')
    <h1 class="page-title">Editar Cliente</h1>

    @if ($errors->any())
        <div class="error-box">
            <strong>Revisa los errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombres:</label><br>
                <input type="text" name="nombres" value="{{ old('nombres', $cliente->nombres) }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos:</label><br>
                <input type="text" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
            </div>

            <div class="form-group">
                <label>Correo:</label><br>
                <input type="email" name="correo" value="{{ old('correo', $cliente->correo) }}" required>
            </div>

            <button type="submit" class="btn btn-blue">Actualizar cliente</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection