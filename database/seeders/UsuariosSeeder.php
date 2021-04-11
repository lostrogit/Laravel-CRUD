<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('Administrador1*'),
            'cedula' => '123456789',
            'ciudad' => 1,
            'fecha_nacimiento' => '1990-01-01 00:00:00',
        ]);
    }

}
