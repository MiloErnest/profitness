<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sports_clothes', function (Blueprint $table) {
            // Campos adicionales para mostrar productos en la tienda
            $table->string('gender')->nullable()->after('product_name'); // hombre / mujer
            $table->string('category')->nullable()->after('gender'); // zapatillas, polos, leggings...
            $table->string('image')->nullable()->after('category'); // ruta o nombre de imagen
            $table->text('description')->nullable()->after('image'); // descripción del producto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sports_clothes', function (Blueprint $table) {
            $table->dropColumn(['gender', 'category', 'image', 'description']);
        });
    }
};
