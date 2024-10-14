<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    // Solo los campos que están presentes en la tabla, eliminando 'respuesta_texto'
    protected $fillable = [
        'user_id',  // Referencia a la clave foránea de usuarios
        'consulta_texto',
        'fecha',
    ];

    // Relación con la tabla de usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');  // Relación belongsTo con User
    }
}
