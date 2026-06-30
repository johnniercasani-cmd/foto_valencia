<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolCliente = Rol::where('nombre', 'cliente')->first();
        $rolAsistente = Rol::where('nombre', 'asistente')->first();
        $rolAdministrador = Rol::where('nombre', 'administrador')->first();

        User::updateOrCreate(
            ['email' => 'admin@fotovalencia.com'],
            [
                'name' => 'Administrador Foto Valencia',
                'rol_id' => $rolAdministrador->id,
                'telefono' => '900000001',
                'estado' => 'ACTIVO',
                'password' => Hash::make('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'asistente@fotovalencia.com'],
            [
                'name' => 'Asistente Foto Valencia',
                'rol_id' => $rolAsistente->id,
                'telefono' => '900000002',
                'estado' => 'ACTIVO',
                'password' => Hash::make('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@fotovalencia.com'],
            [
                'name' => 'Cliente Foto Valencia',
                'rol_id' => $rolCliente->id,
                'telefono' => '900000003',
                'estado' => 'ACTIVO',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}