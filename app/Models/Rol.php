<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    //CONSIDERO QUE LOS ROLES SOLO SON 2 -> ADMINISTRADOR = 1 ; PERSONAL = 2
    //ACA OBTENEMOS EL NOMBRE DEL ADMINISTRADOR ES LO UNICO QUE NECESITAMOS MOSTRARLE AL USUARIO
    protected $table = 'roles';

    protected $fillable = [
        'nombre', 
        
    ];
}