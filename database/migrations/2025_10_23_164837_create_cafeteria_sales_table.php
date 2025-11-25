<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafeteria_sales', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('category')->nullable(); 
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafeteria_sales');
    }
};
