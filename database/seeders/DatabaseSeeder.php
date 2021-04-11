<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Se inicia insersion de registros en DB!');
        $this->call([
            PaisSeeder::class,
            EstadoSeeder::class,
            CiudadSeeder::class,
            UsuariosSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
