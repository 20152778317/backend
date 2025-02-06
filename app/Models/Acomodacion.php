<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acomodacion extends Model
{
    use HasFactory;

    protected $table = 'acomodaciones';  // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = ['nombre'];
}
