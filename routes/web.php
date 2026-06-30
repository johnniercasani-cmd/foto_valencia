<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ApiServicioController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\FotografoController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/api/servicios', [ApiServicioController::class, 'servicios'])
    ->name('api.servicios');

Route::get('/dashboard', function () {
    if (auth()->user()->rol && auth()->user()->rol->nombre === 'cliente') {
        return view('dashboard_cliente');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['rol:administrador,cliente'])->group(function () {
        Route::resource('servicios', ServicioController::class);
    });

    Route::middleware(['rol:administrador,asistente'])->group(function () {
        Route::resource('clientes', ClienteController::class);

        Route::resource('pagos', PagoController::class)->except(['store']);

        Route::resource('fotografos', FotografoController::class);

        Route::get('/reportes/ventas', [ReporteController::class, 'ventas'])
            ->name('reportes.ventas');

        Route::get('/calendario', [CalendarioController::class, 'index'])
            ->name('calendario.index');
    });

    Route::middleware(['rol:administrador,asistente,cliente'])->group(function () {
        Route::resource('reservas', ReservaController::class);

        Route::get('/api/horarios-disponibles', [ReservaController::class, 'horariosDisponibles'])
            ->name('api.horarios.disponibles');

        Route::get('/reservas/{reserva}/pagos/create', [PagoController::class, 'createDesdeReserva'])
            ->name('reservas.pagos.create');

        Route::post('/pagos', [PagoController::class, 'store'])
            ->name('pagos.store');
    });

    Route::middleware(['rol:administrador'])->group(function () {
        Route::resource('equipos', EquipoController::class);
    });

});

require __DIR__.'/auth.php';