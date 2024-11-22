<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class RegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regimen_laboral')->insert([
            ['nombre' => 'nombrado', 'descripcion' => 'Esclavo a tiempo completo'],
            ['nombre' => 'contratado', 'descripcion' => 'De chill'],
        ]);
    }
}
