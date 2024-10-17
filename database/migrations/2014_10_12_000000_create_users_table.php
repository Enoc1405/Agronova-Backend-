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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del usuario
            $table->string('last_name'); // Apellido del usuario
            $table->string('email')->unique(); // Correo electrónico único
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable(); // Dirección del usuario
            $table->string('city')->nullable(); // Ciudad del usuario
            $table->string('country')->nullable(); // País del usuario
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
