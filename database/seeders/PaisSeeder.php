<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/pais.sql';
        \DB::unprepared(file_get_contents($path));
        $this->command->info('registros de tabla pais insertados!');
    }
}
