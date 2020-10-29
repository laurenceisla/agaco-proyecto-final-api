<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['nombre' => 'JOSÉ RODRIGUEZ QUISPE', 'email' => 'jrodriguez@gmail.com', 'password' => Hash::make('12345678'), 'perfil_id' => 1],
            ['nombre' => 'LAURENCE PABLO ISLA CALDERÓN', 'email' => 'lisla@gmail.com', 'password' => Hash::make('12345678'), 'perfil_id' => 2],
            ['nombre' => 'FREDDY JESÚS MORI ESTRADA', 'email' => 'fmori@gmail.com', 'password' => Hash::make('12345678'), 'perfil_id' => 3],
            ['nombre' => 'ERIKSON FELIPE NAPÁN VILLAGARAY', 'email' => 'enapan@gmail.com', 'password' => Hash::make('12345678'), 'perfil_id' => 4],
        ]);
    }
}
