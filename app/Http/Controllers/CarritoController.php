<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        // Obtiene el carrito del usuario autenticado con la relación 'producto'
        $carrito = Carrito::with('producto')->where('user_id', Auth::id())->get();

        // Calcula el subtotal
        $subtotal = $carrito->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });

        // Calcula los impuestos y el total
        $impuestos = $subtotal * 0.18; 
        $total = $subtotal + $impuestos;

        // Retorna la vista del carrito
        return view('carrito.index', compact('carrito', 'subtotal', 'impuestos', 'total'));
    }

    public function add(Request $request, Producto $producto)
    {
        // Busca si el producto ya está en el carrito del usuario
        $carrito = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->first();

        if ($carrito) {
            // Si el producto ya está en el carrito, incrementa la cantidad
            $carrito->increment('cantidad');
        } else {
            // Si no está en el carrito, crea un nuevo registro
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $producto->id,
                'cantidad' => 1,
            ]);
        }

        // Redirige al carrito con un mensaje de éxito
        return redirect()->route('admin.carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request, Carrito $carrito)
    {
        // Valida que la cantidad sea numérica y mayor a 0
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Actualiza la cantidad basada en la acción o el valor proporcionado
        if ($request->action === 'incrementar') {
            $nuevaCantidad = $carrito->cantidad + 1;
        } elseif ($request->action === 'decrementar') {
            $nuevaCantidad = max($carrito->cantidad - 1, 1); // Evita valores menores a 1
        } else {
            $nuevaCantidad = $request->cantidad;
        }

        // Actualiza la cantidad en la base de datos
        $carrito->update(['cantidad' => $nuevaCantidad]);

        return redirect()->route('admin.carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function destroy(Carrito $carrito)
    {
        // Elimina el producto del carrito
        $carrito->delete();

        return redirect()->route('admin.carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
    public function checkout()
    {
        // Lógica para procesar el pedido o mostrar la página de checkout
        return view('admin.carrito.checkout');
    }

}
