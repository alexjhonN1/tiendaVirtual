<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargo_laboral')->insert([
            ['nombre' => 'Ingeniero de chistemas', 'descripcion' => 'Experto en contar chistes'],
            ['nombre' => 'Abogato', 'descripcion' => 'Que hace un abogato'],
        ]);
    
    }
}
