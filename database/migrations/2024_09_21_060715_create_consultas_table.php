<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConsultasTable extends Migration
{
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();  // Clave primaria auto-incrementada
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Clave foránea que referencia la tabla 'users'
            $table->text('consulta_texto');
            $table->text('respuesta_texto')->nullable();  // La respuesta es opcional, por lo tanto, es nullable
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));  // Asigna la fecha actual por defecto
            $table->timestamps();  // Incluye las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
