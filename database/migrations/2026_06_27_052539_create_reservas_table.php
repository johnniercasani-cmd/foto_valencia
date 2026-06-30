<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->cascadeOnDelete();

            $table->foreignId('servicio_id')
                  ->constrained('servicios')
                  ->cascadeOnDelete();

            $table->date('fecha_reserva');
            $table->time('hora_reserva');

            $table->string('lugar_sesion', 150)->nullable();
            $table->integer('numero_personas')->default(1);

            $table->string('estado_reserva', 30)->default('PENDIENTE');

            $table->text('observaciones')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
