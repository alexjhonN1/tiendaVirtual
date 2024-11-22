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
    <h2>Registro de Nuevos Usuarios</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.register.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" maxlength="8" pattern="\d{8}" placeholder="Ingrese solo numeros, no sea burro" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control" maxlength="150" required>
        </div>

        <div class="form-group">
            <label for="numero_telefono">Número de Teléfono</label>
            <input type="text" name="numero_telefono" id="numero_telefono" class="form-control" maxlength="9" pattern="\d{9}" placeholder="Ingrese solo numeros, no sea burro" required>
        </div>

        <div class="form-group">
            <label for="codigo_empleado">Código de Empleado</label>
            <input type="text" name="codigo_empleado" id="codigo_empleado" class="form-control" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio_laboral">Fecha de Inicio Laboral</label>
            <input type="date" name="fecha_inicio_laboral" id="fecha_inicio_laboral" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin_contrato">Fecha de Fin de Contrato</label>
            <input type="date" name="fecha_fin_contrato" id="fecha_fin_contrato" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" minlength="8" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="8" required>
        </div>

        <div class="form-group">
            <label for="rol_id">Rol</label>
            <select name="rol_id" id="rol_id" class="form-control" required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cargo_laboral_id">Cargo Laboral</label>
            <select class="form-control" id="cargo_laboral_id" name="cargo_laboral_id" required>
                @foreach ($cargosLaborales as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
            <small><a href="{{ route('admin.cargos.create') }}">Crear nuevo cargo laboral</a></small>
        </div>

        <div class="form-group">
            <label for="regimen_laboral_id">Régimen Laboral</label>
            <select name="regimen_laboral_id" id="regimen_laboral_id" class="form-control" required>
                <option value="">Seleccione un régimen laboral</option>
                @foreach($regimenesLaborales as $regimen)
                    <option value="{{ $regimen->id }}">{{ $regimen->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
    </form>
</div>

<script>
    document.getElementById('nombre').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    document.getElementById('apellido').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>
@endsection