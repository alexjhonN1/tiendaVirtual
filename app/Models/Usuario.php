<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; 

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'nombre_usuario', 
        'correo',
        'numero_telefono',
        'codigo_empleado',
        'fecha_inicio_laboral',
        'fecha_fin_contrato',
        'password',
        'rol_id', 
        'cargo_laboral_id', 
        'regimen_laboral_id', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio_laboral' => 'date',
            'fecha_fin_contrato' => 'date', 
            'password' => 'hashed',
        ];
    }
    
    //HAY QUE PONER LAS RELACIONES SI NO VA A MORIR EL PROGRAMITA XD
    //ESTA PARTE SI ES IMPORTANTE PARA LAS CONSULTAS
    // Relación con el modelo CargoLaboral
    public function cargoLaboral()
    {
        return $this->belongsTo(CargoLaboral::class, 'cargo_laboral_id');
    }

    // Relación con el modelo RegimenLaboral
    public function regimenLaboral()
    {
        return $this->belongsTo(RegimenLaboral::class, 'regimen_laboral_id');
    }

    // Relación con el modelo Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con los documentos del usuario
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'usuario_id');
    }
}
