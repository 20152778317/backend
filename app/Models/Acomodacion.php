<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acomodacion extends Model
{
    use HasFactory;

    protected $table = 'acomodaciones'; 

    protected $fillable = ['nombre'];
}
