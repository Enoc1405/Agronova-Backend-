<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Asegúrate de incluir esto

class Estadisticas extends Model
{
    use HasFactory;

    // Nombre de la tabla (en caso de que no siga la convención en plural)
    protected $table = 'estadisticas';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'user_id', 
        'numero_consultas', 
        'temas_mas_consultados', 
        'satisfaccion_usuario'
    ];

    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
