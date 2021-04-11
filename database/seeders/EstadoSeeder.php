<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/estado.sql';
        \DB::unprepared(file_get_contents($path));
        $this->command->info('registros de tabla estado insertados!');
    }
}
