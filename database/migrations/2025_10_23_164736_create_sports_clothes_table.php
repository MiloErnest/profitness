<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('sports_clothes', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); // Ejemplo: Licra, Top, Camiseta
            $table->integer('received')->default(0); // Entradas al inventario
            $table->integer('sold')->default(0); // Salidas o ventas
            $table->integer('stock')->default(0); // Existencias actuales
            $table->decimal('unit_price', 10, 2)->nullable(); // Precio unitario
            $table->decimal('total_value', 12, 2)->nullable(); // Valor total
            $table->date('date')->nullable(); // Fecha de registro o conteo
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_clothes');
    }
};
