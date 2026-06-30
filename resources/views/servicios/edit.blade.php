@extends('layouts.foto')

@section('title', 'Editar Servicio - Foto Valencia')

@section('content')
    <h1 class="page-title">Editar Servicio</h1>

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
        <form action="{{ route('servicios.update', $servicio) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre del servicio:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required>
            </div>

            <div class="form-group">
                <label>Descripción:</label><br>
                <textarea name="descripcion" rows="4">{{ old('descripcion', $servicio->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label>Precio:</label><br>
                <input type="number" name="precio" step="0.01" value="{{ old('precio', $servicio->precio) }}" required>
            </div>

            <div class="form-group">
                <label>Duración en minutos:</label><br>
                <input type="number" name="duracion_minutos" value="{{ old('duracion_minutos', $servicio->duracion_minutos) }}" required>
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado" required>
                    <option value="ACTIVO" {{ old('estado', $servicio->estado) == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado', $servicio->estado) == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>

            <button type="submit" class="btn btn-blue">Actualizar servicio</button>
            <a href="{{ route('servicios.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection