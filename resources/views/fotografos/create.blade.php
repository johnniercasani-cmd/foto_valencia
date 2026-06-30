@extends('layouts.foto')

@section('title', 'Nuevo Fotógrafo')

@section('content')
    <h1 class="page-title">Registrar Fotógrafo</h1>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('fotografos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="form-group">
                <label>Correo:</label><br>
                <input type="email" name="correo" value="{{ old('correo') }}">
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado" required>
                    <option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>

            <button type="submit" class="btn btn-blue">Guardar</button>
            <a href="{{ route('fotografos.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection