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
        Schema::create('cafeteria_monthly_reports', function (Blueprint $table) {
            $table->id();
            
            // Identificación del período
            $table->integer('year')->comment('Año del reporte');
            $table->integer('month')->comment('Mes del reporte (1-12)');
            
            // Datos del producto
            $table->foreignId('cafeteria_sale_id')->nullable()->constrained('cafeteria_sales')->onDelete('set null');
            $table->string('product_name');
            $table->string('category');
            
            // Control de inventario del mes
            $table->integer('received')->default(0)->comment('Recibido en el mes');
            $table->integer('additional_stock')->default(0)->comment('Adicional en el mes');
            $table->integer('sold')->default(0)->comment('Vendido en el mes');
            $table->integer('lost_stock')->default(0)->comment('Pérdidas en el mes');
            $table->integer('final_stock')->default(0)->comment('Stock al final del mes');
            
            // Precios y valores
            $table->decimal('cost_price', 10, 2)->default(0)->comment('Precio de compra');
            $table->decimal('sale_price', 10, 2)->default(0)->comment('Precio de venta');
            $table->decimal('total_sales_value', 10, 2)->default(0)->comment('Valor total vendido');
            $table->decimal('total_cost_value', 10, 2)->default(0)->comment('Costo de lo vendido');
            $table->decimal('profit', 10, 2)->default(0)->comment('Ganancia del producto');
            $table->decimal('stock_value', 10, 2)->default(0)->comment('Valor del stock final');
            $table->decimal('losses_value', 10, 2)->default(0)->comment('Valor de pérdidas');
            
            // Estado del cierre
            $table->boolean('is_closed')->default(false)->comment('Si el mes está cerrado');
            $table->text('notes')->nullable()->comment('Notas del mes');
            
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['year', 'month']);
            $table->index('cafeteria_sale_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafeteria_monthly_reports');
    }
};
