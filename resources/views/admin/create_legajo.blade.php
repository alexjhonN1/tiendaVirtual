@extends('layouts.navbar')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif

@section('content')
<div class="container">
    <h2>Crear Legajo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.legajos.buscar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dni">Buscar Usuario por DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if(isset($usuarioInfo))
        <h3>Información del Usuario</h3>
        <p><strong>Nombre:</strong> {{ $usuarioInfo['nombre'] }}</p>
        <p><strong>Apellido:</strong> {{ $usuarioInfo['apellido'] }}</p>
        <p><strong>DNI:</strong> {{ $usuarioInfo['dni'] }}</p>
        <p><strong>Cargo Laboral:</strong> {{ $usuarioInfo['cargo_laboral'] }}</p>
        <p><strong>Descripción del Cargo:</strong> {{ $usuarioInfo['descripcion_cargo'] }}</p>
        <p><strong>Régimen Laboral:</strong> {{ $usuarioInfo['regimen_laboral'] }}</p>
        <p><strong>Fecha de Inicio:</strong> {{ $usuarioInfo['fecha_inicio_laboral'] }}</p>
        <p><strong>Fecha de Fin de Contrato:</strong> {{ $usuarioInfo['fecha_fin_contrato'] }}</p>

        <form action="{{ route('admin.legajos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
            <div class="form-group">
                <label for="numero_expediente">Número de Expediente</label>
                <input type="text" name="numero_expediente" id="numero_expediente" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="archivo">Documento PDF</label>
                <input type="file" name="archivo" id="archivo" class="form-control" accept="application/pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Legajo</button>
        </form>
    @endif
</div>
@endsection
