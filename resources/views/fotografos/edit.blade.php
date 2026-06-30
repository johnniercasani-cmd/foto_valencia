@extends('layouts.foto')

@section('title', 'Editar Fotógrafo')

@section('content')
    <h1 class="page-title">Editar Fotógrafo</h1>

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
        <form action="{{ route('fotografos.update', $fotografo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre', $fotografo->nombre) }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono', $fotografo->telefono) }}">
            </div>

            <div class="form-group">
                <label>Correo:</label><br>
                <input type="email" name="correo" value="{{ old('correo', $fotografo->correo) }}">
            </div>

            <div class="form-group">
                <label>Estado:</label><br>
                <select name="estado" required>
                    <option value="ACTIVO" {{ old('estado', $fotografo->estado) == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado', $fotografo->estado) == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>

            <button type="submit" class="btn btn-blue">Actualizar</button>
            <a href="{{ route('fotografos.index') }}" class="btn btn-gray">Volver</a>
        </form>
    </div>
@endsection