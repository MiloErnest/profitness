<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\CafeteriaSale;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin por defecto (PostgreSQL prod no tiene usuarios de SQLite local).
        // Contraseña en texto plano: el modelo User aplica cast 'hashed' (no usar bcrypt aquí).
        User::updateOrCreate(
            ['email' => 'admin@fitness.com'],
            [
                'name' => 'Administrador',
                'password' => '12345678',
                'role' => 'admin',
            ]
        );

        // Suplementos y ropa: solo desde el panel admin (no borrar ni reinsertar en cada deploy).

        // --- Servicios del gimnasio ---
        Service::insertOrIgnore([
            ['name' => 'Entrenamiento Personalizado', 'description' => 'Sesiones 1 a 1 con entrenador certificado.', 'price' => 80000],
            ['name' => 'Clases de Spinning', 'description' => 'Entrenamientos grupales de alta intensidad.', 'price' => 50000],
            ['name' => 'CrossFit', 'description' => 'Entrenamientos de fuerza y resistencia avanzada.', 'price' => 60000],
        ]);

        // --- Productos de cafetería ---
        CafeteriaSale::insertOrIgnore([
            ['product_name' => 'Batido Proteico', 'category' => 'Bebida', 'price' => 12000, 'stock' => 30, 'description' => 'Hecho con proteína whey y fruta natural.', 'image' => 'batido.jpg'],
            ['product_name' => 'Barra Energética', 'category' => 'Snack', 'price' => 5000, 'stock' => 50, 'description' => 'Ideal para antes o después del entrenamiento.', 'image' => 'barra.jpg'],
            ['product_name' => 'Café Fitness', 'category' => 'Bebida', 'price' => 8000, 'stock' => 40, 'description' => 'Café bajo en calorías y alto en energía.', 'image' => 'cafe.jpg'],
        ]);
    }
}
