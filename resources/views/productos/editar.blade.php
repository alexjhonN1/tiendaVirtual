@extends('layouts.app')

@section('content')
<h1>Editar Producto</h1>

<!-- Mensajes de error -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            class="form-control" 
            value="{{ old('nombre', $producto->nombre) }}" 
            placeholder="Ingrese el nombre del producto"
            required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea 
            name="descripcion" 
            id="descripcion" 
            class="form-control" 
            placeholder="Ingrese una descripción detallada del producto" 
            required>{{ old('descripcion', $producto->descripcion) }}</textarea>
    </div>
    <div class="form-group">
        <label for="precio">Precio:</label>
        <input 
            type="number" 
            name="precio" 
            id="precio" 
            class="form-control" 
            step="0.01" 
            value="{{ old('precio', $producto->precio) }}" 
            placeholder="Ingrese el precio del producto"
            required>
    </div>
    <div class="form-group">
        <label for="stock">Stock:</label>
        <input 
            type="number" 
            name="stock" 
            id="stock" 
            class="form-control" 
            value="{{ old('stock', $producto->stock) }}" 
            placeholder="Ingrese la cantidad en stock"
            required>
    </div>
    <div class="form-group">
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" id="categoria_id" class="form-control" required>
            <option value="">Seleccione una categoría</option>
            @foreach($categorias as $categoria)
                <option 
                    value="{{ $categoria->id }}" 
                    {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input 
            type="file" 
            name="imagen" 
            id="imagen" 
            class="form-control">
        @if($producto->imagen)
        <div class="mt-2">
            <p>Imagen actual:</p>
            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" class="img-thumbnail" style="width: 150px;">
        </div>
        @endif
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary mt-3">Regresar</a>
</form>
@endsection
