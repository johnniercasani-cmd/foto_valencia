@extends('layouts.foto')

@section('title', 'Registrar Servicio - Foto Valencia')

@section('content')
    <h1 class="page-title">Registrar Servicio</h1>

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
        <form action="{{ route('servicios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombre del servicio:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label>Descripción:</label><br>
                <textarea name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <label>Precio:</label><br>
                <input type="number" name="precio" step="0.01" value="{{ old('precio') }}" required>
            </div>

            <div class="form-group">
                <label>Duración en minutos:</label><br>
                <input type="number" name="duracion_minutos" value="{{ old('duracion_minutos') }}" required>
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado" required>
                    <option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>

            <button type="submit" class="btn btn-blue">Guardar servicio</button>
            <a href="{{ route('servicios.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection