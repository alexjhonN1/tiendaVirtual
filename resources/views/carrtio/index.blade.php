@extends('layouts.app')

@section('content')
<h1>Carrito de Compras</h1>

@if($carrito->isEmpty())
    <p>No tienes productos en el carrito.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->producto->precio }}</td>
                <td>
                    <form action="{{ route('carrito.update', $item) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" class="form-control">
                        <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                    </form>
                </td>
                <td>{{ $item->producto->precio * $item->cantidad }}</td>
                <td>
                    <form action="{{ route('carrito.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Subtotal: {{ $subtotal }}</p>
    <p>Impuestos: {{ $impuestos }}</p>
    <h3>Total: {{ $total }}</h3>
@endif
@endsection
