@extends('layouts.foto')

@section('title', 'Editar Equipo - Foto Valencia')

@section('content')
    <h1 class="page-title">Editar Equipo</h1>

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
        <form action="{{ route('equipos.update', $equipo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre del equipo:</label><br>
                <input type="text" name="nombre_equipo" value="{{ old('nombre_equipo', $equipo->nombre_equipo) }}" required>
            </div>

            <div class="form-group">
                <label>Tipo de equipo:</label><br>
                <input type="text" name="tipo_equipo" value="{{ old('tipo_equipo', $equipo->tipo_equipo) }}">
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado_equipo" required>
                    <option value="OPERATIVO" {{ old('estado_equipo', $equipo->estado_equipo) == 'OPERATIVO' ? 'selected' : '' }}>OPERATIVO</option>
                    <option value="MANTENIMIENTO" {{ old('estado_equipo', $equipo->estado_equipo) == 'MANTENIMIENTO' ? 'selected' : '' }}>MANTENIMIENTO</option>
                    <option value="DAÑADO" {{ old('estado_equipo', $equipo->estado_equipo) == 'DAÑADO' ? 'selected' : '' }}>DAÑADO</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de mantenimiento:</label><br>
                <input type="date" name="fecha_mantenimiento" value="{{ old('fecha_mantenimiento', $equipo->fecha_mantenimiento) }}">
            </div>

            <div class="form-group">
                <label>Observaciones:</label><br>
                <textarea name="observaciones" rows="4">{{ old('observaciones', $equipo->observaciones) }}</textarea>
            </div>

            <button type="submit" class="btn btn-blue">Actualizar equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection