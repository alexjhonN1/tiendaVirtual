{{-- resources/views/productos/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>{{ $producto->nombre }}</h1>
    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
    <p><strong>Precio:</strong> {{ $producto->precio }}</p>
    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock }}</p>

    @if($producto->imagen)
        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
    @endif
@endsection
