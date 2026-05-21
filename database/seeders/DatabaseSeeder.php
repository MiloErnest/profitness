<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Supplement;
use App\Models\SportClothes;
use App\Models\CafeteriaSale;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Verificar si el admin ya existe ---
        if (!User::where('email', 'admin@fitness.com')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@fitness.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ]);
        }

        // --- Servicios del gimnasio ---
        Service::insertOrIgnore([
            ['name' => 'Entrenamiento Personalizado', 'description' => 'Sesiones 1 a 1 con entrenador certificado.', 'price' => 80000],
            ['name' => 'Clases de Spinning', 'description' => 'Entrenamientos grupales de alta intensidad.', 'price' => 50000],
            ['name' => 'CrossFit', 'description' => 'Entrenamientos de fuerza y resistencia avanzada.', 'price' => 60000],
        ]);

        // --- Suplementos de ejemplo ---
        Supplement::insertOrIgnore([
            ['name' => 'Proteína Whey', 'category' => 'Proteína', 'price' => 150000, 'stock' => 20, 'description' => 'Ideal para recuperación muscular.', 'image' => 'whey.jpg'],
            ['name' => 'Creatina Monohidratada', 'category' => 'Creatina', 'price' => 90000, 'stock' => 15, 'description' => 'Mejora fuerza y rendimiento.', 'image' => 'creatina.jpg'],
            ['name' => 'Pre Entreno Xtreme', 'category' => 'Pre-entreno', 'price' => 70000, 'stock' => 10, 'description' => 'Aumenta energía y concentración.', 'image' => 'preentreno.jpg'],
        ]);

        // --- Ropa deportiva de ejemplo ---
        SportClothes::insertOrIgnore([
            [
                'product_name' => 'Camiseta Dry-Fit',
                'gender' => 'Unisex',
                'category' => 'Camisetas',
                'image' => 'camiseta.jpg',
                'description' => 'Tela transpirable y cómoda.',
                'received' => 50,
                'sold' => 10,
                'stock' => 40,
                'unit_price' => 60000,
                'total_value' => 2400000,
                'date' => now(),
            ],
            [
                'product_name' => 'Leggins Deportivos',
                'gender' => 'Femenino',
                'category' => 'Leggins',
                'image' => 'leggins.jpg',
                'description' => 'Alta elasticidad y confort.',
                'received' => 30,
                'sold' => 5,
                'stock' => 25,
                'unit_price' => 85000,
                'total_value' => 2125000,
                'date' => now(),
            ],
            [
                'product_name' => 'Pantaloneta Gym',
                'gender' => 'Masculino',
                'category' => 'Pantalonetas',
                'image' => 'pantaloneta.jpg',
                'description' => 'Ligera y resistente.',
                'received' => 40,
                'sold' => 8,
                'stock' => 32,
                'unit_price' => 70000,
                'total_value' => 2240000,
                'date' => now(),
            ],
        ]);

        // --- Productos de cafetería ---
        CafeteriaSale::insertOrIgnore([
            ['product_name' => 'Batido Proteico', 'category' => 'Bebida', 'price' => 12000, 'stock' => 30, 'description' => 'Hecho con proteína whey y fruta natural.', 'image' => 'batido.jpg'],
            ['product_name' => 'Barra Energética', 'category' => 'Snack', 'price' => 5000, 'stock' => 50, 'description' => 'Ideal para antes o después del entrenamiento.', 'image' => 'barra.jpg'],
            ['product_name' => 'Café Fitness', 'category' => 'Bebida', 'price' => 8000, 'stock' => 40, 'description' => 'Café bajo en calorías y alto en energía.', 'image' => 'cafe.jpg'],
        ]);
    }
}
