<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\RegimenLaboral;
use App\Models\CargoLaboral;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        //CONSULTAS PARA OBTENER LOS DATOS 
        $regimenesLaborales = RegimenLaboral::all();
        $cargosLaborales = CargoLaboral::all();
        $roles = Rol::all();
        
        return view('admin.register', compact('regimenesLaborales', 'cargosLaborales', 'roles'));
    }

    public function register(Request $request)
    {
        //VALIDAMOS LOS DATOS, PUEDES CAMBIARLO COMO QUIERAS EN REALIDAD SOLO SON VALIDACIONES
        $request->validate([
            'dni' => 'required|string|max:20|unique:usuarios',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'nombre_usuario' => 'required|string|max:100|unique:usuarios',
            'correo' => 'required|string|email|max:150|unique:usuarios',
            'numero_telefono' => 'required|string|max:20',
            'codigo_empleado' => 'required|string|max:50|unique:usuarios',
            'fecha_inicio_laboral' => 'required|date',
            'fecha_fin_contrato' => 'nullable|date',
            'password' => 'required|string|confirmed',
            'rol_id' => 'required|exists:roles,id',
            'cargo_laboral_id' => 'required|exists:cargo_laboral,id',
            'regimen_laboral_id' => 'required|exists:regimen_laboral,id',
        ]);
        //CREAMOS UN NUEVO USUARIO 
        Usuario::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'numero_telefono' => $request->numero_telefono,
            'codigo_empleado' => $request->codigo_empleado,
            'fecha_inicio_laboral' => $request->fecha_inicio_laboral,
            'fecha_fin_contrato' => $request->fecha_fin_contrato,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'cargo_laboral_id' => $request->cargo_laboral_id,
            'regimen_laboral_id' => $request->regimen_laboral_id,
        ]);
        //SI DIOSITO QUIERE TODO REGISTRARA NORMAL 
        return redirect()->route('admin.dashboard')->with('success', 'Usuario registrado exitosamente.');
    }
}
