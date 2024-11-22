@extends('layouts.navbar')

@section('content')
<h2>Buscar y Filtrar Usuarios</h2>

<form action="{{ route('admin.usuarios.buscar.submit') }}" method="POST">
    @csrf
    <!--Comentar en html es feo asi xd-->
    <div class="form-group">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" class="form-control" maxlength="8" pattern="\d{8}" placeholder="Ingrese Solo numeros">
    </div>

    <div class="form-group">
        <label for="cargo_laboral_id">Cargo Laboral</label>
        <select name="cargo_laboral_id" id="cargo_laboral_id" class="form-control">
            <option value="">Seleccione un cargo</option>
            @foreach($cargos as $cargo)
                <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="regimen_laboral_id">Régimen Laboral</label>
        <select name="regimen_laboral_id" id="regimen_laboral_id" class="form-control">
            <option value="">Seleccione un régimen</option>
            @foreach($regimenes as $regimen)
                <option value="{{ $regimen->id }}">{{ $regimen->nombre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Buscar</button>
</form>
@endsection
