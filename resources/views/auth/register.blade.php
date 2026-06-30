@extends('layouts.auth-foto')

@section('title', 'Crear cuenta - Foto Valencia')

@section('content')
    <div class="auth-card">
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

        <h1 class="auth-title">Crea una cuenta</h1>
        <p class="auth-subtitle">
            Cree una cuenta para obtener todos los beneficios que ofrece el estudio
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text"
                           id="nombres"
                           name="nombres"
                           value="{{ old('nombres') }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text"
                           id="apellidos"
                           name="apellidos"
                           value="{{ old('apellidos') }}"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Correo electronico</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password"
                       id="password"
                       name="password"
                       required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Vuelva a insertar su contraseña</label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       required>
            </div>

            <button type="submit" class="btn-primary">
                Crear cuenta
            </button>

            <a href="{{ route('login') }}" class="btn-secondary">
                Ya tengo cuenta
            </a>
        </form>
    </div>
@endsection