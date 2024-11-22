<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.crear', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        Producto::create($data);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto creado con éxito!');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.editar', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        $producto->update($data);

        return redirect()->route('admin.productos.index')->with('success', '¡Producto actualizado con éxito!');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', '¡Producto eliminado con éxito!');
    }

    public function buscar(Request $request)
{
    $query = Producto::query();

    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('categoria_id')) {
        $query->where('categoria_id', $request->categoria_id);
    }

    if ($request->filled('precio_min')) {
        $query->where('precio', '>=', $request->precio_min);
    }

    if ($request->filled('precio_max')) {
        $query->where('precio', '<=', $request->precio_max);
    }

    if ($request->filled('ordenar')) {
        switch ($request->ordenar) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'popularidad':
                $query->orderBy('popularidad', 'desc');
                break;
        }
    }

    $productos = $query->with('categoria')->paginate(10);

    $categorias = Categoria::all();

    return view('productos.buscar', compact('productos', 'categorias'));
}
}
