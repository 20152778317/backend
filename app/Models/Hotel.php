<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model {
    use HasFactory;

    protected $table = 'hoteles'; // Asegúrate de que coincida con la migración

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'nit'
    ];
}

