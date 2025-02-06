<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcomodacionSeeder extends Seeder
{
    public function run()
    {
        DB::table('acomodaciones')->insert([
            ['id' => 1, 'nombre' => 'Sencilla', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Doble', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nombre' => 'Triple', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nombre' => 'Cuádruple', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
