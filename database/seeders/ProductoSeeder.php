<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            ['nombre' => 'ESCRITORIO'],
            ['nombre' => 'ROPERO DOBLE PUERTA'],
            ['nombre' => 'CENTRO DE ENTRETENIMIENTO'],
            ['nombre' => 'CAMA DE MADERA'],
        ]);
    }
}
