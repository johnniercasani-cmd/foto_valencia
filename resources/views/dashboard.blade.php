@extends('layouts.foto')

@section('title', 'Panel Principal - Foto Valencia')

@section('content')
    <h1 class="page-title">Sistema de Reservas Foto Valencia</h1>

    <div class="card">
        <p>
            Bienvenido, <strong>{{ Auth::user()->name }}</strong>
        </p>

        <p>
            Rol:
            <strong>
                {{ Auth::user()->rol ? Auth::user()->rol->nombre : 'Sin rol asignado' }}
            </strong>
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; max-width: 950px;">

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'cliente']))
            <a href="{{ route('servicios.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Servicios</h2>
                <p>Consultar y administrar los servicios fotográficos disponibles.</p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('clientes.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Clientes</h2>
                <p>Registrar y administrar los datos de los clientes.</p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente', 'cliente']))
            <a href="{{ route('reservas.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Reservas</h2>
                <p>Registrar, consultar, reprogramar o cancelar citas fotográficas.</p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('pagos.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Pagos</h2>
                <p>Registrar pagos y confirmar reservas de clientes.</p>
            </a>
        @endif

        @if (Auth::user()->rol && Auth::user()->rol->nombre == 'administrador')
            <a href="{{ route('equipos.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Inventario</h2>
                <p>Controlar cámaras, luces, lentes y equipos del estudio.</p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('reportes.ventas') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Reporte de ventas</h2>
                <p>Consultar ingresos generados por reservas y pagos.</p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('calendario.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Agenda de Reservas</h2>
                <p>
                    Visualiza las sesiones programadas por fecha, horario, cliente,
                    servicio y fotógrafo asignado.
                </p>
            </a>
        @endif

        @if (Auth::user()->rol && in_array(Auth::user()->rol->nombre, ['administrador', 'asistente']))
            <a href="{{ route('fotografos.index') }}" class="card" style="text-decoration: none; color: black;">
                <h2>Fotógrafos</h2>
                <p>Registrar y administrar los fotógrafos disponibles para las sesiones.</p>
            </a>
        @endif

    </div>
@endsection