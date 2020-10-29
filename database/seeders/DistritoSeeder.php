<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distritos')->insert([
            ['nombre' => 'ATE'],
            ['nombre' => 'BREÑA'],
            ['nombre' => 'JESÚS MARÍA'],
            ['nombre' => 'LIMA'],
            ['nombre' => 'SAN JUAN DE MIRAFLORES'],
            ['nombre' => 'SAN MIGUEL'],
        ]);
    }
}
