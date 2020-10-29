<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_servicio')->insert([
            ['nombre' => 'ENVÍO'],
            ['nombre' => 'ARMADO'],
        ]);
    }
}
