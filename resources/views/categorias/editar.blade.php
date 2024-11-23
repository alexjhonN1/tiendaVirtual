@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="container">
    <h1>Editar Categoría</h1>

    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
=======
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
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f
@endsection
