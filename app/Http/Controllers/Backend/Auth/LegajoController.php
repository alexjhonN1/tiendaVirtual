<?php

namespace App\Http\Controllers\Backend\Auth;
/**
 * ACA SI ESTA LO BRUTAL ESTAN TODAS LAS FUNCIONES PARA MANIPULAR EL LEGAJO, CREAR, ACTUALIZAR, LEER, TODO 
 * 
 */
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\CargoLaboral;
use App\Models\RegimenLaboral;
use App\Models\Documento;
use Illuminate\Http\Request;

class LegajoController extends Controller
{

    public function create()
    {
        return view('admin.create_legajo');
    }
    //FUNCION PARA BUSCAR USUARIO POR DNI
    //OJO XD ESTOY BUSCANDO POR DNI PORQUE ES MAS FACIL Y ME PARECE LO CORRECTO Y LA MEJOR OPCION
    public function buscarUsuario(Request $request)
    {   
        //ACA VALIDAMOS LOS DATOS NOMA Y HACEMOS CONSULTAS CON LARAVELS
        $request->validate([
            'dni' => 'required|string',
        ]);
        
        $usuario = Usuario::where('dni', $request->dni)->first();
        
        if (!$usuario) {
            return back()->withErrors(['dni' => 'No se encontró un usuario con el DNI proporcionado.']);
        }

        //ESTAMOS CREANDO UN ARRAY CON LOS DATOS DEL USUARIO :D
        $usuarioInfo = [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'dni' => $usuario->dni,
            'cargo_laboral' => $usuario->cargoLaboral->nombre,
            'descripcion_cargo' => $usuario->cargoLaboral->descripcion,
            'regimen_laboral' => $usuario->regimenLaboral->nombre,
            'fecha_inicio_laboral' => $usuario->fecha_inicio_laboral,
            'fecha_fin_contrato' => $usuario->fecha_fin_contrato ?? 'Indeterminado',
        ];

        return view('admin.create_legajo', compact('usuario', 'usuarioInfo'));
    }
    
    //ESTO ES PARA GUARDAR EL LEGAJO EN SI ES UN ARCHIVITO PDF NOMA QUE NO PESE MAS DE DOS MEGAS
    public function store(Request $request)
    {   
        //IGUAL PRIMERO VALIDAMOS QUE EXISTA EL USUARIO NO XD 
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'numero_expediente' => 'required|string|max:50|unique:documentos',
            //LE PUEDES PONER UN TAMAÑO MAXIMO EN MEGABITS ACA ESTA EN 2 MB
            'archivo' => 'required|file|mimes:pdf|max:2048', 
        ]);

        $file = $request->file('archivo');
        $filePath = $file->store('legajos', 'public');

        Documento::create([
            'usuario_id' => $request->usuario_id,
            'ruta_archivo' => $filePath,
            'nombre_archivo' => $file->getClientOriginalName(),
            'numero_expediente' => $request->numero_expediente,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Legajo creado exitosamente.');
    }
    
    public function showUpdateForm()
    {
        return view('admin.update_legajo');
    }   

    public function buscarUsuarioParaActualizar(Request $request)
    {   
        //PARA ACTUALIZAR IGUAL NOMA PRIMERO HAY QUE BUSCAR, POR DNI XD 
        //SE PUEDE BUSCAR POR LO QUE QUIERAS EN REALIDAD BUSCAR POR ID SERIA MEJOR :V (CREO) PERO SON COSITAS
        $request->validate([
            'dni' => 'required|string',
        ]);
            
        $usuario = Usuario::where('dni', $request->dni)->first();
    
        if (!$usuario) {
            return back()->withErrors(['dni' => 'No se encontró un usuario con el DNI proporcionado.']);
        }
    
        $legajo = Documento::where('usuario_id', $usuario->id)->first();
    
        if (!$legajo) {
            return back()->withErrors(['dni' => 'El usuario no tiene un legajo registrado.']);
        }
    
        $usuarioInfo = [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'dni' => $usuario->dni,
            'correo' => $usuario->correo,
            'numero_telefono' => $usuario->numero_telefono,
            'nombre_usuario' => $usuario->nombre_usuario,
            'cargo_laboral' => $usuario->cargoLaboral->nombre,
            'descripcion_cargo' => $usuario->cargoLaboral->descripcion,
            'regimen_laboral' => $usuario->regimenLaboral->nombre,
            'fecha_inicio_laboral' => $usuario->fecha_inicio_laboral,
            'fecha_fin_contrato' => $usuario->fecha_fin_contrato ?? 'Indeterminado',
            'numero_expediente' => $legajo->numero_expediente, 
            'nombre_archivo' => $legajo->nombre_archivo,
        ];
        //SI TE FIJAS XD ES IGUAL NOMA QUE EL OTRO :V EL PROBLEMA ES QUE ESTE RETORNA OTRA VISTA
        //TAL VEZ  SE PUEDA OSEA ESTOY CASI SEGURO QUE SE PUEDE RETORNAR DOS VISTAS, PERO ME DA FLOJERA BUSCAR LA DOCUMENTACION
        return view('admin.update_legajo', compact('usuario', 'usuarioInfo', 'legajo'));
    }
    //FUNCION PARA ACTUALIZAR NOMA
    public function actualizarLegajo(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'correo' => 'required|string|email|max:150',
            'numero_telefono' => 'required|string|max:20',
            'nombre_usuario' => 'required|string|max:100',
            'fecha_inicio_laboral' => 'required|date',
            'fecha_fin_contrato' => 'nullable|date',
            'archivo' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Buscar usuario y legajo
        $usuario = Usuario::find($request->usuario_id);
        $legajo = Documento::where('usuario_id', $usuario->id)->first();

        // ACTUALIZAR LE PUEDES METER LO QUE QUIERAS 
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'numero_telefono' => $request->numero_telefono,
            'nombre_usuario' => $request->nombre_usuario,
            'fecha_inicio_laboral' => $request->fecha_inicio_laboral,
            'fecha_fin_contrato' => $request->fecha_fin_contrato,
        ]);

        // ESTA PARTE ES PARA EL DOCUMENTO
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $filePath = $file->store('legajos', 'public');

            // Actualizar documento
            $legajo->update([
                'ruta_archivo' => $filePath,
                'nombre_archivo' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Legajo actualizado exitosamente.');
    }
    
    //ACA COMIENZAN LAS BUSQUEDAS
    public function mostrarBusqueda()
    {
        
        $cargos = CargoLaboral::all();
        $regimenes = RegimenLaboral::all();

        return view('admin.buscar_usuarios', compact('cargos', 'regimenes'));
    }
    
    //ACA FILTRAS O BUSCAS
    public function buscarUsuarios(Request $request)
    {
        $query = Usuario::query();

        // Filtrar por DNI
        if ($request->filled('dni')) {
            $query->where('dni', $request->dni);
        }

        // Filtrar por cargo
        if ($request->filled('cargo_laboral_id')) {
            $query->where('cargo_laboral_id', $request->cargo_laboral_id);
        }

        // Filtrar por régimen laboral
        if ($request->filled('regimen_laboral_id')) {
            $query->where('regimen_laboral_id', $request->regimen_laboral_id);
        }

        $usuarios = $query->get();

        return view('admin.resultados_busqueda', compact('usuarios'));
    }
    
    //ESTA PARTE ES PARA EL PERSONAL MORTAL
    public function createLegajo()
    {
        $usuario = auth()->user(); 
        $legajo = Documento::where('usuario_id', $usuario->id)->first(); 
    
        return view('user.create_legajo', compact('usuario', 'legajo')); 
    }

    //GUARDAR LEGAJOS PARA MORTALES
    public function storeLegajo(Request $request)
    {
        $request->validate([
            'numero_expediente' => 'required|string|max:50|unique:documentos',
            'archivo' => 'required|file|mimes:pdf|max:2048', 
        ]);
    
        
        $usuario = auth()->user();
    
        $file = $request->file('archivo');
        $filePath = $file->store('legajos', 'public');
    
        Documento::create([
            'usuario_id' => $usuario->id, 
            'ruta_archivo' => $filePath,
            'nombre_archivo' => $file->getClientOriginalName(),
            'numero_expediente' => $request->numero_expediente,
        ]);
    
        return redirect()->route('user.dashboard')->with('success', 'Legajo creado exitosamente.');
    }
}
