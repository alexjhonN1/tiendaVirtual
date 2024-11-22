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
    <h2>Actualizar Legajo</h2>

    <!-- Formulario para buscar por DNI -->
    <form action="{{ route('admin.legajo.buscar.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" maxlength="8" pattern="\d{8}" placeholder="Ingrese solo numeros, no sea burro" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar Usuario</button>
    </form>

    @if (isset($usuarioInfo))
        <!-- Formulario para actualizar el legajo -->
        <form action="{{ route('admin.legajo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Agrega un campo oculto para el ID del usuario -->
        <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{ $usuarioInfo['dni'] }}" readonly>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuarioInfo['nombre'] }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $usuarioInfo['apellido'] }}" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control" value="{{ $usuarioInfo['correo'] }}" required>
        </div>

        <div class="form-group">
            <label for="numero_telefono">Número de Teléfono</label>
            <input type="text" name="numero_telefono" id="numero_telefono" class="form-control" value="{{ $usuarioInfo['numero_telefono'] }}" required>
        </div>

        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ $usuarioInfo['nombre_usuario'] }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio_laboral">Fecha de Inicio Laboral</label>
            <input type="date" name="fecha_inicio_laboral" id="fecha_inicio_laboral" class="form-control" value="{{ $usuarioInfo['fecha_inicio_laboral'] }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin_contrato">Fecha de Fin de Contrato</label>
            <input type="date" name="fecha_fin_contrato" id="fecha_fin_contrato" class="form-control" value="{{ $usuarioInfo['fecha_fin_contrato'] }}">
        </div>

        <div class="form-group">
            <label for="numero_expediente">Número de Expediente</label>
            <input type="text" name="numero_expediente" id="numero_expediente" class="form-control" value="{{ $usuarioInfo['numero_expediente'] }}" readonly>
        </div>

        <div class="form-group">
            <label for="ruta_archivo">Documento Asociado</label>
            <a href="{{ asset('storage/' . $legajo->ruta_archivo) }}" target="_blank">Ver Documento</a>
        </div>

        <div class="form-group">
            <label for="archivo">Subir Nuevo Documento</label>
            <input type="file" name="archivo" id="archivo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Legajo</button>
    </form>
    @endif
@endsection
