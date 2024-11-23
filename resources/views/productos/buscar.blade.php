@extends('layouts.app')

@section('content')
<h1>Búsqueda Avanzada de Productos</h1>

<!-- Formulario de búsqueda -->
<form action="{{ route('productos.buscar') }}" method="GET">
    <div class="form-group">
        <label for="nombre">Nombre del Producto:</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            class="form-control" 
            value="{{ request('nombre') }}" 
            placeholder="Ingrese el nombre del producto">
    </div>

    <div class="form-group">
        <label for="categoria">Categoría:</label>
        <select name="categoria_id" id="categoria" class="form-control">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option 
                    value="{{ $categoria->id }}" 
                    {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="precio_min">Precio Mínimo:</label>
        <input 
            type="number" 
            name="precio_min" 
            id="precio_min" 
            class="form-control" 
            value="{{ request('precio_min') }}" 
            placeholder="Ingrese el precio mínimo">
    </div>

    <div class="form-group">
        <label for="precio_max">Precio Máximo:</label>
        <input 
            type="number" 
            name="precio_max" 
            id="precio_max" 
            class="form-control" 
            value="{{ request('precio_max') }}" 
            placeholder="Ingrese el precio máximo">
    </div>

    <div class="form-group">
        <label for="ordenar">Ordenar Por:</label>
        <select name="ordenar" id="ordenar" class="form-control">
            <option value="">Relevancia</option>
            <option value="precio_asc" {{ request('ordenar') == 'precio_asc' ? 'selected' : '' }}>Precio Ascendente</option>
            <option value="precio_desc" {{ request('ordenar') == 'precio_desc' ? 'selected' : '' }}>Precio Descendente</option>
            <option value="popularidad" {{ request('ordenar') == 'popularidad' ? 'selected' : '' }}>Popularidad</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<!-- Resultados de búsqueda -->
@if(isset($productos) && $productos->isNotEmpty())
    <h2 class="mt-4">Resultados de la búsqueda</h2>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Popularidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->popularidad ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $productos->links() }}
@elseif(isset($productos))
    <p class="text-warning mt-4">No se encontraron productos que coincidan con los criterios de búsqueda.</p>
@endif
@endsection
