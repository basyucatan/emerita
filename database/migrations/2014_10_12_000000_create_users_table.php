<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deptos', function (Blueprint $table) {
            $table->id();
            $table->string('depto',20);
        });   
                
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdDepto')->nullable()->constrained('deptos')->nullOnDelete();
            $table->string('name');
            $table->string('telefono')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('activo')->default(true);
            $table->json('adicionales')->nullable();
            $table->rememberToken();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('deptos');
        Schema::dropIfExists('users');
    }
};

// Ejecutar una sola migracion
//php artisan migrate --path=database/migrations/2025_07_14_000000_create_movs.php
//php artisan migrate:rollback --path=database/migrations/2025_07_14_000000_create_movs.php

