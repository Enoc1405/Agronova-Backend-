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
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->id();  // Clave primaria
            $table->unsignedBigInteger('user_id');  // Nombre de la columna que referencia a users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Clave foránea
            $table->integer('numero_consultas');
            $table->text('temas_mas_consultados');
            $table->integer('satisfaccion_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadisticas');
    }
};
