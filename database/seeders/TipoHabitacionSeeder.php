<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHabitacionSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_habitacion')->insert([
            ['id' => 1, 'nombre' => 'Estándar', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Junior', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nombre' => 'Suite', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

