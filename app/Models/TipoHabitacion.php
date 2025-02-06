<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    use HasFactory;

    // Asegúrate de que el nombre de la tabla sea correcto
    protected $table = 'tipos_habitacion';

    // Los campos que se pueden asignar masivamente
    protected $fillable = ['nombre'];
}
