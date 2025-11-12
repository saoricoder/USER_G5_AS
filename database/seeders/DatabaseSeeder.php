<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Asegurar un usuario de prueba idempotente para desarrollo
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'nombre' => 'Test User',
                'password' => bcrypt('password123'),
                'fecha_nacimiento' => '1999-01-01',
                'sexo' => 'Masculino',
                'numero_seguro' => '123456789',
                'historial_medico' => 'Histoial medico de prueba',
                'contacto_emergencia' => '1234567890',
            ]
        );
    }
}
