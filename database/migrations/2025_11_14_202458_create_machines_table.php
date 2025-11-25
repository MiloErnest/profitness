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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable()->comment('Categoría: Pesas, Cardio, Funcional, etc.');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('brand')->nullable()->comment('Marca del equipo');
            $table->string('location')->nullable()->comment('Ubicación en el gimnasio');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
