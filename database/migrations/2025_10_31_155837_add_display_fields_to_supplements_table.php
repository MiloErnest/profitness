<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('supplements')) {
            return;
        }

        Schema::table('supplements', function (Blueprint $table) {
            if (!Schema::hasColumn('supplements', 'category')) {
                $table->string('category')->nullable()->after('name');
            }
            if (!Schema::hasColumn('supplements', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('supplements', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('supplements', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('supplements')) {
            return;
        }

        Schema::table('supplements', function (Blueprint $table) {
            $columns = ['category', 'description', 'image', 'price'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('supplements', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
