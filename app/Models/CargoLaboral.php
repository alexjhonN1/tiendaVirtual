<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoLaboral extends Model
{
    use HasFactory;

    protected $table = 'cargo_laboral';
    
    protected $fillable = [
        'nombre', 
        'descripcion',
    ];
}