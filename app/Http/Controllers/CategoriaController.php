<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
<<<<<<< HEAD
        return view('categorias.index', compact('categorias'));
=======
        return view('backend.categorias.index', compact('categorias'));
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f
    }

    public function create()
    {
        return view('categorias.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Categoria::create($request->all());

        return redirect()->route('admin.categorias.index')->with('success', '¡Categoría creada con éxito!');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.editar', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($request->all());

        return redirect()->route('admin.categorias.index')->with('success', '¡Categoría actualizada con éxito!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success', '¡Categoría eliminada con éxito!');
    }
}
