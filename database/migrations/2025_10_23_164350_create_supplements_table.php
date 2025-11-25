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
            // Campos que ya deberían existir (por si acaso)
            if (!Schema::hasColumn('supplements', 'category')) {
                $table->string('category')->nullable()->after('name');
            }
            if (!Schema::hasColumn('supplements', 'description')) {
                $table->text('description')->nullable()->after('category');
            }
            if (!Schema::hasColumn('supplements', 'price')) {
                $table->decimal('price', 10, 2)->default(0)->after('description');
            }
            if (!Schema::hasColumn('supplements', 'image')) {
                $table->string('image')->nullable()->after('price');
            }
            
            // NUEVOS CAMPOS para el control completo de inventario
            if (!Schema::hasColumn('supplements', 'additional_stock')) {
                $table->integer('additional_stock')->default(0)->after('received')
                    ->comment('Mercancía adicional: donaciones, devoluciones, ajustes positivos');
            }
            
            if (!Schema::hasColumn('supplements', 'lost_stock')) {
                $table->integer('lost_stock')->default(0)->after('sold')
                    ->comment('Pérdidas: robos, vencidos, muestras gratis, daños');
            }
            
            if (!Schema::hasColumn('supplements', 'notes')) {
                $table->text('notes')->nullable()->after('date')
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
            $table->dropColumn(['additional_stock', 'lost_stock', 'notes']);
        });
    }
};