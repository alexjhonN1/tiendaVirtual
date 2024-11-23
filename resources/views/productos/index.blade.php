@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    
    <!-- Botón para Crear Producto -->
    <div class="mb-3">
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear Producto</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>
                        <!-- Botón para Editar Producto -->
                        <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Botón para Eliminar Producto -->
                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>

                        <!-- Botón para Ver Detalles (Opcional) -->
                        <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-info btn-sm">Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $productos->links() }}
</div>
@endsection
