<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsuarioSeeder;
use Database\Seeders\DoctorSeeder; 
use Database\Seeders\HistoriaMedicaSeeder; // Importar

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsuarioSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(HistoriaMedicaSeeder::class); // Añadir la llamada
    }
}
// Fin de database/seeders/DatabaseSeeder.php
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
