<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Foto Valencia')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #1e1e1e;
        }

        .page-wrapper {
            width: 96%;
            min-height: 92vh;
            margin: 15px auto;
            background: white;
            border: 4px solid #111;
        }

        .navbar {
            height: 65px;
            background: #1f1f1f;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            color: white;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            width: 55px;
            height: 55px;
            object-fit: contain;
            background: white;
            border-radius: 4px;
        }

        .brand-text {
            font-weight: bold;
            font-size: 18px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a,
        .nav-links button {
            color: white;
            text-decoration: none;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            text-decoration: underline;
        }

        .content {
            padding: 35px 65px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 800;
            font-style: italic;
            margin-bottom: 30px;
            color: #000;
        }

        .actions {
            margin-bottom: 25px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 9px 18px;
            border-radius: 20px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-blue {
            background: #7db5f0;
            color: #000;
        }

        .btn-yellow {
            background: #e6e36a;
            color: #000;
        }

        .btn-red {
            background: #f05b5b;
            color: #000;
        }

        .btn-green {
            background: #8ee28e;
            color: #000;
        }

        .btn-gray {
            background: #e5e5e5;
            color: #000;
        }

        .card {
            background: #e9e9e9;
            border-radius: 40px;
            padding: 22px 30px;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #e9e9e9;
            border-radius: 30px;
            overflow: hidden;
        }

        th {
            text-align: left;
            font-size: 20px;
            padding: 18px;
            color: #000;
        }

        td {
            padding: 14px 18px;
            font-size: 16px;
            border-top: 1px solid #d0d0d0;
        }

        .success {
            background: #d4f8d4;
            padding: 12px 18px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error-box {
            background: #ffd6d6;
            padding: 12px 18px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        input, select, textarea {
            width: 100%;
            max-width: 450px;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #ccc;
            background: #efefef;
            margin-top: 5px;
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="navbar">
            <div class="logo-box">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Foto Valencia" class="logo">
                <span class="brand-text">Foto Valencia</span>
            </div>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Inicio</a>
            
                @auth
                    @php
                        $rol = auth()->user()->rol->nombre ?? null;
                    @endphp
            
                    <a href="{{ route('reservas.index') }}">Reservas</a>
            
                    @if ($rol === 'administrador' || $rol === 'asistente')
                        <a href="{{ route('calendario.index') }}">Agenda</a>
                        <a href="{{ route('fotografos.index') }}">Fotógrafos</a>
                        <a href="{{ route('pagos.index') }}">Pagos</a>
                        <a href="{{ route('reportes.ventas') }}">Reportes</a>
                    @endif
            
                    @if ($rol === 'administrador')
                        <a href="{{ route('equipos.index') }}">Equipos</a>
                    @endif
            
                    <a href="{{ route('profile.edit') }}">Cuenta</a>
            
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Salir</button>
                    </form>
                @endauth
            </div>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>
</html>