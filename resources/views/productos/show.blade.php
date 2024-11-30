@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Producto principal -->
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

        <!-- Sección de Reseñas -->
        <div class="mt-5">
            <h3>Reseñas</h3>

            <!-- Mostrar las reseñas -->
            @if($reseñas->isEmpty())
                <p>No hay reseñas para este producto aún.</p>
            @else
                <ul class="list-group">
                    @foreach($reseñas as $resena)
                        <li class="list-group-item">
                            <strong>{{ $resena->user->name }}:</strong>
                            <span>{{ $resena->comentario }}</span>
                            <br>
                            <strong>Calificación:</strong> {{ $resena->calificacion }} ⭐
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Mostrar mensaje de éxito si la reseña fue enviada correctamente -->
            @if(session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario para agregar una nueva reseña -->
            @auth
                <!-- Verificar si el usuario ya ha dejado una reseña -->
                @if($producto->reseñas && !$producto->reseñas->where('user_id', auth()->id())->isEmpty())
                    <p>Ya has dejado una reseña para este producto.</p>
                @else
                    <form action="{{ route('admin.productos.resenas', $producto->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="comentario">Deja tu comentario:</label>
                            <textarea name="comentario" id="comentario" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="calificacion">Calificación (1-5):</label>
                            <input type="number" name="calificacion" id="calificacion" class="form-control" min="1" max="5" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Enviar Reseña</button>
                    </form>
                @endif
            @endauth

            @guest
                <p>Para dejar una reseña, debes estar <a href="{{ route('login') }}">logueado</a>.</p>
            @endguest
        </div>
    </div>
@endsection
