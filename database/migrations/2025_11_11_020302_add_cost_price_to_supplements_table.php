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
            if (!Schema::hasColumn('supplements', 'cost_price')) {
                $table->decimal('cost_price', 10, 2)->default(0)->after('price')
                    ->comment('Precio de compra/costo del producto');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplements', function (Blueprint $table) {
            if (Schema::hasColumn('supplements', 'cost_price')) {
                $table->dropColumn('cost_price');
            }
        });
    }
};
