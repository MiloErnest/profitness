<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('duration_days');
            $table->unsignedInteger('price');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('membership_plans')->insert([
            ['name' => 'Día', 'duration_days' => 1, 'price' => 8000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semana', 'duration_days' => 7, 'price' => 30000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quincena', 'duration_days' => 15, 'price' => 45000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mes', 'duration_days' => 30, 'price' => 70000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plan Pareja', 'duration_days' => 30, 'price' => 120000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
