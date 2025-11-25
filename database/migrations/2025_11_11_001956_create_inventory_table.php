<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('product_type'); // 'supplement', 'cafeteria', 'clothing'
            $table->unsignedBigInteger('product_id'); // ID del producto en su tabla
            $table->string('product_name');
            $table->integer('initial_stock')->default(0); // Stock inicial
            $table->integer('current_stock')->default(0); // Stock actual
            $table->integer('sold_quantity')->default(0); // Cantidad vendida
            $table->decimal('cost_price', 10, 2); // Precio de costo
            $table->decimal('sale_price', 10, 2); // Precio de venta
            $table->decimal('total_value', 12, 2)->default(0); // Valor total en inventario
            $table->date('last_restock_date')->nullable(); // Última fecha de reabastecimiento
            $table->text('notes')->nullable(); // Notas del inventario
            $table->timestamps();

            // Índices para mejor rendimiento
            $table->index(['product_type', 'product_id']);
            $table->index('current_stock');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};