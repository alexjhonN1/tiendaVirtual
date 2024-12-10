@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Productos</h1>

    <!-- Botón para Crear Producto -->
    <div class="mb-3">
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear Producto</a>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">INICIO</a>
    </div>

    <!-- Grilla de Productos -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($productos as $producto)
        <div class="col">
            <div class="card h-100">
                <!-- Imagen del Producto -->
                @if ($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 200px; object-fit: cover;">
                @else
                <img src="https://via.placeholder.com/200" class="card-img-top" alt="Sin Imagen" style="height: 200px; object-fit: cover;">
                @endif

                <!-- Cuerpo de la Tarjeta -->
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">Precio: S/ {{ $producto->precio ?? 'N/A' }}</p>
                    <p class="card-text">{{ $producto->descripcion ?? 'Descripción no disponible' }}</p>
                </div>

                <!-- Acciones -->
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-info btn-sm">Detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <!-- <div class="mt-4">
        {{ $productos->links() }}
    </div> -->
</div>
@endsection
