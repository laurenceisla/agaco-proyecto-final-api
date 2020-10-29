<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoIdentidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_documento_identidad')->insert([
            ['nombre' => 'DNI', 'abreviatura' => 'DNI'],
            ['nombre' => 'CARNÉ DE EXTRANJERÍA', 'abreviatura' => 'CE'],
            ['nombre' => 'PERMISO TEMPORAL DE PERMANENCIA', 'abreviatura' => 'PTP'],
        ]);
    }
}
