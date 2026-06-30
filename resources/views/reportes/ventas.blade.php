@extends('layouts.foto')

@section('title', 'Reporte de Ventas')

@section('content')
    <div class="page-header">
        <h1>Reporte de Ventas</h1>
        <p>Reporte generado desde la vista SQL <strong>vista_reporte_ventas</strong>.</p>
    </div>

    <div class="cards-grid">
        <div class="card">
            <h3>Total vendido</h3>
            <p style="font-size: 24px; font-weight: bold;">
                S/ {{ number_format($totalVentas, 2) }}
            </p>
        </div>

        <div class="card">
            <h3>Cantidad de pagos</h3>
            <p style="font-size: 24px; font-weight: bold;">
                {{ $cantidadPagos }}
            </p>
        </div>

        <div class="card">
            <h3>Pagos registrados</h3>
            <p style="font-size: 24px; font-weight: bold;">
                {{ $pagosRegistrados }}
            </p>
        </div>

        <div class="card">
            <h3>Pagos en verificación</h3>
            <p style="font-size: 24px; font-weight: bold;">
                {{ $pagosPendientes }}
            </p>
        </div>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h2>Detalle de ventas</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Pago</th>
                    <th>Reserva</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Monto</th>
                    <th>Método</th>
                    <th>Estado Pago</th>
                    <th>Fecha Pago</th>
                    <th>Estado Reserva</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->pago_id }}</td>
                        <td>{{ $venta->reserva_id }}</td>
                        <td>{{ $venta->cliente }}</td>
                        <td>{{ $venta->servicio }}</td>
                        <td>S/ {{ number_format($venta->monto_pagado, 2) }}</td>
                        <td>{{ $venta->metodo_pago }}</td>
                        <td>{{ $venta->estado_pago }}</td>
                        <td>{{ $venta->fecha_pago }}</td>
                        <td>{{ $venta->estado_reserva }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection