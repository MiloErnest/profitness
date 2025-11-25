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
            // Campos de control de inventario
            if (!Schema::hasColumn('sports_clothes', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('unit_price')
                    ->comment('Precio de venta al público');
            }
            
            if (!Schema::hasColumn('sports_clothes', 'cost_price')) {
                $table->decimal('cost_price', 10, 2)->default(0)->after('price')
                    ->comment('Precio de compra/costo del producto');
            }
            
            if (!Schema::hasColumn('sports_clothes', 'additional_stock')) {
                $table->integer('additional_stock')->default(0)->after('received')
                    ->comment('Mercancía adicional: donaciones, devoluciones, ajustes positivos');
            }
            
            if (!Schema::hasColumn('sports_clothes', 'lost_stock')) {
                $table->integer('lost_stock')->default(0)->after('sold')
                    ->comment('Pérdidas: robos, daños, muestras gratis');
            }
            
            if (!Schema::hasColumn('sports_clothes', 'notes')) {
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
        Schema::table('sports_clothes', function (Blueprint $table) {
            $columns = ['price', 'cost_price', 'additional_stock', 'lost_stock', 'notes'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('sports_clothes', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
