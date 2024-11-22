<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'administrador', 'descripcion' => 'Administrador del sistema'],
            ['nombre' => 'personal', 'descripcion' => 'Empleado común'],
        ]);
    }
}
