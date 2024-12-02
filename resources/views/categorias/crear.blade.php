@extends('layouts.app')

@section('content')
<h1>Crear Categoría</h1>

<form action="{{ route('admin.categorias.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@endsection
