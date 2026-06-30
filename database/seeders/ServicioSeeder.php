<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicios')->insert([
            [
                'nombre' => 'Sesión fotográfica personal',
                'descripcion' => 'Sesión individual para fotos profesionales o de recuerdo.',
                'precio' => 80.00,
                'duracion_minutos' => 60,
                'estado' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sesión familiar',
                'descripcion' => 'Sesión fotográfica para familias en estudio o exterior.',
                'precio' => 150.00,
                'duracion_minutos' => 90,
                'estado' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cuadro de promoción',
                'descripcion' => 'Servicio de fotografía y diseño para cuadros de promoción.',
                'precio' => 250.00,
                'duracion_minutos' => 120,
                'estado' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Restauración de fotografía',
                'descripcion' => 'Servicio de restauración digital de fotografías antiguas.',
                'precio' => 60.00,
                'duracion_minutos' => 45,
                'estado' => 'ACTIVO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}