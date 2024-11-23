@extends('layouts.app')

@section('content')
<h1>Editar Categoría</h1>

<form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $categoria->descripcion }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
@endsection
