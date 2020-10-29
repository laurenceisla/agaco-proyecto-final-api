<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert([
            ['nombre' => 'VENDEDOR'],
            ['nombre' => 'COORDINADOR'],
            ['nombre' => 'TRANSPORTISTA'],
            ['nombre' => 'ESPECIALISTA'],
        ]);
    }
}
