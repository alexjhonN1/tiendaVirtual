<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\CargoLaboral;
use Illuminate\Http\Request;

class CargoLaboralController extends Controller
{
    
    public function create()
    {
        return view('admin.createCargo'); 
    }
    //CON ESTO VALIDAS LOS DATOS Y GUARDAS EN TU BASE DE DATOS EL CARGO_LABORAL
    //EN SI TODO SE RELACIONA CON EL MODELO CargoLaboral
    public function store(Request $request)
    {   
        //VALIDAR :D
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255', 
        ]);
        //CREAR :D
        CargoLaboral::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion, 
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Cargo laboral creado exitosamente.');
    }
}
