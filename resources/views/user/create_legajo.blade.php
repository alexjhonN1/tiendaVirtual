@extends('layouts.navbar')

@section('content')
<div class="container">
    <h1>Subir Legajo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h3>Información del Usuario</h3>
    <ul>
        <li><strong>Nombre:</strong> {{ $usuario->nombre }} {{ $usuario->apellido }}</li>
        <li><strong>DNI:</strong> {{ $usuario->dni }}</li>
        <li><strong>Correo:</strong> {{ $usuario->correo }}</li>
        <li><strong>Teléfono:</strong> {{ $usuario->numero_telefono }}</li>
        <li><strong>Cargo:</strong> {{ $usuario->cargoLaboral->nombre }}</li>
        <li><strong>Régimen Laboral:</strong> {{ $usuario->regimenLaboral->nombre }}</li>
    </ul>

    @if ($legajo)
        <h3>Legajo Existente</h3>
        <ul>
            <li><strong>Número de Expediente:</strong> {{ $legajo->numero_expediente }}</li>
            <li><strong>Nombre del Archivo:</strong> {{ $legajo->nombre_archivo }}</li>
            <li><strong>Ruta del Archivo:</strong> <a href="{{ asset('storage/' . $legajo->ruta_archivo) }}" target="_blank">Ver Archivo</a></li>
        </ul>
        
        <form action="{{ route('legajo.update', $legajo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <h4>Actualizar Legajo</h4>
            <div class="form-group">
                <label for="numero_expediente">Nuevo Número de Expediente (opcional)</label>
                <input type="text" name="numero_expediente" class="form-control">
            </div>

            <div class="form-group">
                <label for="archivo">Nuevo Archivo (PDF, opcional)</label>
                <input type="file" name="archivo" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning">Actualizar Legajo</button>
        </form>
    @else
        <form action="{{ route('legajo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="numero_expediente">Número de Expediente</label>
                <input type="text" name="numero_expediente" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="archivo">Archivo (PDF)</label>
                <input type="file" name="archivo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Subir Legajo</button>
        </form>
    @endif
</div>
@endsection
