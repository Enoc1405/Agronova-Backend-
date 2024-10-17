<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // Los campos que pueden ser llenados masivamente
    protected $fillable = [
        'name',
        'last_name', // Apellido del usuario
        'email',
        'password',
        'address', // Dirección del usuario
        'city',    // Ciudad del usuario
        'country', // País del usuario
    ];

    // Los campos que se ocultarán cuando el modelo se serialice
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Los atributos que deben ser convertidos a tipos nativos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

  
}
