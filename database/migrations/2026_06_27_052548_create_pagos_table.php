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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reserva_id')
                  ->constrained('reservas')
                  ->cascadeOnDelete();

            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago', 50);
            $table->string('codigo_operacion', 100)->nullable();

            $table->string('estado_pago', 30)->default('REGISTRADO');
            $table->dateTime('fecha_pago')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
