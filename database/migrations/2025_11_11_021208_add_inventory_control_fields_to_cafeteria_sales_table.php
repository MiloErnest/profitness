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
        Schema::table('cafeteria_sales', function (Blueprint $table) {
            // Campos de control de inventario
            if (!Schema::hasColumn('cafeteria_sales', 'received')) {
                $table->integer('received')->default(0)->after('stock')
                    ->comment('Unidades recibidas o compradas');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'additional_stock')) {
                $table->integer('additional_stock')->default(0)->after('received')
                    ->comment('Mercancía adicional: donaciones, devoluciones, ajustes positivos');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'sold')) {
                $table->integer('sold')->default(0)->after('additional_stock')
                    ->comment('Unidades vendidas');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'lost_stock')) {
                $table->integer('lost_stock')->default(0)->after('sold')
                    ->comment('Pérdidas: vencidos, muestras gratis, daños');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'cost_price')) {
                $table->decimal('cost_price', 10, 2)->default(0)->after('price')
                    ->comment('Precio de compra/costo del producto');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'unit_price')) {
                $table->decimal('unit_price', 10, 2)->default(0)->after('cost_price')
                    ->comment('Precio unitario (copia de price para compatibilidad)');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'total_value')) {
                $table->decimal('total_value', 10, 2)->default(0)->after('unit_price')
                    ->comment('Valor total del inventario (stock * precio)');
            }
            
            if (!Schema::hasColumn('cafeteria_sales', 'notes')) {
                $table->text('notes')->nullable()->after('total_value')
                    ->comment('Notas u observaciones del producto');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cafeteria_sales', function (Blueprint $table) {
            $columns = ['received', 'additional_stock', 'sold', 'lost_stock', 'cost_price', 'unit_price', 'total_value', 'notes'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('cafeteria_sales', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
