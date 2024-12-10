@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>

    @if($carrito->isEmpty())
        <div class="alert alert-info">
            Tu carrito está vacío.
        </div>
    @else
        <!-- Tabla con productos en el carrito -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>{{ number_format($item->producto->precio, 2) }} USD</td>
                        <td>
                            <!-- Contador de cantidad -->
                            <form action="{{ route('admin.carrito.update', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex align-items-center">
                                    <button type="submit" name="action" value="decrementar" class="btn btn-light btn-sm">-</button>
                                    <span class="mx-2">{{ $item->cantidad }}</span>
                                    <button type="submit" name="action" value="incrementar" class="btn btn-light btn-sm">+</button>
                                </div>
                            </form>
                        </td>
                        <td>{{ number_format($item->producto->precio * $item->cantidad, 2) }} USD</td>
                        <td>
                            <!-- Botón para eliminar producto -->
                            <form action="{{ route('admin.carrito.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Resumen del carrito -->
        <div class="mt-3">
            <h4>Resumen:</h4>
            <p>Subtotal: <strong>{{ number_format($subtotal, 2) }} USD</strong></p>
            <p>Impuestos (18%): <strong>{{ number_format($impuestos, 2) }} USD</strong></p>
            <p>Total: <strong>{{ number_format($total, 2) }} USD</strong></p>
        </div>

        <!-- Botón para Comprar Ahora -->
        <a href="#" class="btn btn-primary mt-3">Comprar Ahora</a>

        <!-- Botón para seguir comprando -->
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary mt-3">Seguir Comprando</a>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">INICIO</a>
    @endif
</div>
@endsection
