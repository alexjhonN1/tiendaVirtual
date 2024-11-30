<?php


namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    // Mostrar las reseñas de un producto
    public function show(Producto $producto)
    {
        // Obtener todas las reseñas del producto
        $reseñas = $producto->reseñas()->get();
        
        return view('productos.reseñas', compact('producto', 'reseñas'));
    }

    // Almacenar una nueva reseña
    public function store(Request $request, Producto $producto)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para dejar una reseña');
        }
    
        // Validar los datos de la reseña
        $request->validate([
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);
    
        // Verificar si el usuario ya ha dejado una reseña para este producto
        if ($producto->reseñas()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('producto.reseñas', $producto->id)
                             ->with('error', 'Ya has dejado una reseña para este producto.');
        }
    
        // Crear una nueva reseña
        Resena::create([
            'producto_id' => $producto->id,
            'user_id' => Auth::id(),
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'aprobado' => 0,  // Asumimos que las reseñas son moderadas y no aprobadas por defecto
        ]);
    
        return redirect()->route('producto.reseñas', $producto->id)
                         ->with('success', 'Reseña enviada exitosamente, está pendiente de aprobación');
    }
    
}
