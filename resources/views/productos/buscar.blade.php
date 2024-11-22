@extends('layouts.app')

@section('content')
<h1>Buscar Productos</h1>

<form action="{{ route('productos.buscar') }}" method="GET">
    <div class="form-group">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}">
    </div>

    <div class="form-group">
        <label for="categoria">Categoría:</label>
        <select name="categoria_id" id="categoria" class="form-control">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="precio_min">Precio Mínimo:</label>
        <input type="number" name="precio_min" id="precio_min" class="form-control" value="{{ request('precio_min') }}">
    </div>

    <div class="form-group">
        <label for="precio_max">Precio Máximo:</label>
        <input type="number" name="precio_max" id="precio_max" class="form-control" value="{{ request('precio_max') }}">
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

@if(isset($productos))
<h2>Resultados de la búsqueda</h2>
<table class="table">
    <thead>
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
            <td>{{ $producto->popularidad }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $productos->links() }}
@endif
@endsection
