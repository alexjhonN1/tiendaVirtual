@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Producto principal: Sudadera -->
        <div class="row">
            <div class="col-md-6">
                <!-- Imagen del producto -->
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
                @else
                    <img src="default-image.jpg" alt="Producto sin imagen" class="img-fluid">
                @endif
            </div>
            <div class="col-md-6">
                <!-- Información del producto -->
                <h1>{{ $producto->nombre }}</h1>
                <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>

                <!-- Cuadro para el precio -->
                <div class="border p-3 my-2">
                    <p><strong>Precio Principal:</strong> ${{ number_format($producto->precio, 2) }}</p>
                </div>

                <!-- Cuadro para el precio de compra -->
                <div class="border p-3 my-2">
                    <p><strong>Precio de Compra:</strong> ${{ number_format($producto->precio_compra, 2) }}</p>
                </div>

                <!-- Botón para agregar al carrito -->
                <form action="{{ route('admin.carrito.add', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3">Añadir al carrito</button>
                </form>
            </div>
        </div>
    </div>
@endsection
