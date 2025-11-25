<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportClothes;

class SportsClothesSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // 👕 Hombre
            ['product_name' => 'Zapatillas ProRun', 'gender' => 'hombre', 'category' => 'zapatillas', 'image' => 'zapatos_h1.jpg', 'description' => 'Amortiguación superior y agarre máximo.', 'unit_price' => 220000, 'stock' => 15],
            ['product_name' => 'Polo Dry-Fit', 'gender' => 'hombre', 'category' => 'polos', 'image' => 'camiseta_h1.jpg', 'description' => 'Ligero y transpirable.', 'unit_price' => 85000, 'stock' => 20],
            ['product_name' => 'Jogger Elite', 'gender' => 'hombre', 'category' => 'pantalones', 'image' => 'inferior_h2.jpg', 'description' => 'Suavidad y flexibilidad.', 'unit_price' => 140000, 'stock' => 10],
            ['product_name' => 'Chaqueta Sport Pro', 'gender' => 'hombre', 'category' => 'chaquetas', 'image' => 'chaqueta_h2.jpg', 'description' => 'Diseño moderno y resistente.', 'unit_price' => 170000, 'stock' => 8],

            // 🩱 Mujer
            ['product_name' => 'Top Deportivo Fit', 'gender' => 'mujer', 'category' => 'tops', 'image' => 'camiseta_m1.jpg', 'description' => 'Sujeción y comodidad.', 'unit_price' => 75000, 'stock' => 25],
            ['product_name' => 'Leggings PowerFit', 'gender' => 'mujer', 'category' => 'leggings', 'image' => 'leggings_m2.jpg', 'description' => 'Flexibilidad máxima.', 'unit_price' => 140000, 'stock' => 12],
            ['product_name' => 'Chaqueta FitWind', 'gender' => 'mujer', 'category' => 'chaquetas', 'image' => 'superior_m2.jpg', 'description' => 'Corte entallado.', 'unit_price' => 170000, 'stock' => 6],
            ['product_name' => 'Pantalón Motion', 'gender' => 'mujer', 'category' => 'pantalones', 'image' => 'pantalon_m2.jpg', 'description' => 'Comodidad premium.', 'unit_price' => 125000, 'stock' => 14],
        ];

        foreach ($products as $p) {
            $p['received'] = $p['stock'];
            $p['sold'] = 0;
            $p['total_value'] = $p['stock'] * $p['unit_price'];
            $p['date'] = now();
            SportClothes::create($p);
        }
    }
}
