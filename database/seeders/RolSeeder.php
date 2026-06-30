<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'cliente',
                'descripcion' => 'Usuario que realiza reservas de sesiones fotográficas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'asistente',
                'descripcion' => 'Usuario encargado de gestionar clientes, reservas y pagos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'administrador',
                'descripcion' => 'Usuario encargado de administrar servicios, usuarios e inventario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}