<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fotografo;

class FotografoSeeder extends Seeder
{
    public function run(): void
    {
        Fotografo::updateOrCreate(
            ['correo' => 'fotografo1@fotovalencia.com'],
            [
                'nombre' => 'Carlos Valencia',
                'telefono' => '900000004',
                'estado' => 'ACTIVO',
            ]
        );

        Fotografo::updateOrCreate(
            ['correo' => 'fotografo2@fotovalencia.com'],
            [
                'nombre' => 'María Fernández',
                'telefono' => '900000005',
                'estado' => 'ACTIVO',
            ]
        );
    }
}