@extends('layouts.auth-foto')

@section('title', 'Iniciar sesión - Foto Valencia')

@section('content')
    <div class="auth-card small">
        @if (session('status'))
            <div class="status-box">
                {{ session('status') }}
            </div>
        @endif

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="email"
                       name="email"
                       placeholder="Correo Electrónico"
                       value="{{ old('email') }}"
                       required
                       autofocus>
            </div>

            <div class="form-group">
                <input type="password"
                       name="password"
                       placeholder="Contraseña"
                       required>
            </div>

            <button type="submit" class="btn-primary">
                Iniciar Sesión
            </button>

            <a href="{{ route('register') }}" class="btn-secondary">
                Crear Cuenta nueva
            </a>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </form>
    </div>
@endsection