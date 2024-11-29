<?php


namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseñaController extends Controller
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
        $request->validate([
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        // Crear una nueva reseña para el producto
        Resena::create([
            'producto_id' => $producto->id,
            'user_id' => Auth::id(),
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
        ]);

        return redirect()->route('producto.reseñas', $producto->id)->with('success', 'Reseña enviada exitosamente');
    }
}
