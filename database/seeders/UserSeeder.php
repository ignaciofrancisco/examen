<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin por defecto
        User::create([
            'rut' => '11111111-1',
            'nombre' => 'Admin',
            'apellido' => 'VentasFix',
            'email' => 'admin.ventasfix@ventasfix.cl',
            'password' => bcrypt('admin123'),
        ]);

        // 10 usuarios de prueba
        User::factory(10)->create();
    }
}
