
@extends('layouts.navbar')

@section('content')
    <h1>Dashboard del Administrador</h1>

    <!-- BOTONCITO PARA REGISTRAR -->
    <a href="{{ route('admin.register') }}" class="btn btn-primary">Registrar Nuevo Usuario</a>
    <a href="{{ route('admin.legajos.create') }}" class="btn btn-primary">Registrar Nuevo legajo</a>
    <a href="{{ route('admin.legajo.update.form') }}" class="btn btn-primary">Actualizar Legajo</a>
    <a href="{{ route('admin.usuarios.buscar') }}" class="btn btn-primary">Buscar y Filtrar Usuarios</a>

    <!-- Otras secciones del dashboard -->
@endsection