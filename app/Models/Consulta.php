<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable = [
        'user_id', // Cambiado aquí
        'consulta_texto',
        'respuesta_texto',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id'); // Cambiado aquí
    }
}
