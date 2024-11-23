@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Categorías</h1>

    <!-- Botón para Crear Nueva Categoría -->
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary mb-3">Crear Categoría</a>

    <!-- Tabla de Categorías -->
    <table class="table table-striped">
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
                        <!-- Botón para Editar Categoría -->
                        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón para Eliminar Categoría -->
                        <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
