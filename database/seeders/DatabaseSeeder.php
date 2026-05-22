<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Supplement;
use App\Models\SportClothes;
use App\Models\CafeteriaSale;
use App\Models\Inventory;
use App\Models\SupplementMonthlyReport;
use App\Models\SportClothesMonthlyReport;

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

        // Catálogos vacíos: suplementos y ropa solo desde panel admin.
        SupplementMonthlyReport::query()->delete();
        SportClothesMonthlyReport::query()->delete();
        Inventory::whereIn('product_type', ['supplement', 'clothing'])->delete();
        Supplement::query()->delete();
        SportClothes::query()->delete();

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
