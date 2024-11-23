@extends('layouts.app')

@section('content')
<h1>Lista de Categorías</h1>

<a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Crear Categoría</a>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->nombre }}</td>
            <td>{{ $categoria->descripcion }}</td>
            <td>
                <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categorias->links() }}
@endsection
