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
        $carrito = Carrito::with('producto')->where('user_id', Auth::id())->get();

        $subtotal = $carrito->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });

        $impuestos = $subtotal * 0.18; 
        $total = $subtotal + $impuestos;

        return view('carrito.index', compact('carrito', 'subtotal', 'impuestos', 'total'));
    }

    public function add(Request $request, Producto $producto)
{
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

    // Redirige al usuario al carrito con un mensaje de éxito
    return redirect()->route('admin.carrito.index')->with('success', 'Producto añadido al carrito.');
}

    public function update(Request $request, Carrito $carrito)
    {
        $carrito->update(['cantidad' => $request->cantidad]);

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function destroy(Carrito $carrito)
    {
        $carrito->delete();

        return redirect()->route('admin.carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
