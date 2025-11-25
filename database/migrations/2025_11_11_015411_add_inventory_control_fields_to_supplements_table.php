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
        Schema::table('supplements', function (Blueprint $table) {
            // Verificar y agregar columnas necesarias para control de inventario
            if (!Schema::hasColumn('supplements', 'additional_stock')) {
                $table->integer('additional_stock')->default(0)->after('received')
                    ->comment('Mercancía adicional: donaciones, devoluciones, ajustes positivos');
            }
            
            if (!Schema::hasColumn('supplements', 'lost_stock')) {
                $table->integer('lost_stock')->default(0)->after('sold')
                    ->comment('Pérdidas: robos, vencidos, muestras gratis, daños');
            }
            
            if (!Schema::hasColumn('supplements', 'notes')) {
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
        Schema::table('supplements', function (Blueprint $table) {
            if (Schema::hasColumn('supplements', 'additional_stock')) {
                $table->dropColumn('additional_stock');
            }
            if (Schema::hasColumn('supplements', 'lost_stock')) {
                $table->dropColumn('lost_stock');
            }
            if (Schema::hasColumn('supplements', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
