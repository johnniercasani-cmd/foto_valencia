@extends('layouts.foto')

@section('title', 'Registrar Cliente - Foto Valencia')

@section('content')
    <h1 class="page-title">Registrar Cliente</h1>

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
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombres:</label><br>
                <input type="text" name="nombres" value="{{ old('nombres') }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos:</label><br>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="form-group">
                <label>Correo:</label><br>
                <input type="email" name="correo" value="{{ old('correo') }}" required>
            </div>

            <button type="submit" class="btn btn-blue">Guardar cliente</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection