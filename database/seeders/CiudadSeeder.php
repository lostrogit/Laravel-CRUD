<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/ciudad.sql';
        \DB::unprepared(file_get_contents($path));
        $this->command->info('registros de tabla ciudad insertados!');
    }
}
