@extends('layouts.app')

@section('content')
<h1>Reseñas para {{ $producto->nombre }}</h1>

<!-- Formulario para agregar una reseña -->
@if(auth()->check())
    <form action="{{ route('productos.resenas.agregar', $producto) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" id="comentario" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="calificacion">Calificación (1-5):</label>
            <select name="calificacion" id="calificacion" class="form-control">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Reseña</button>
    </form>
@else
    <p><a href="{{ route('login') }}">Inicia sesión</a> para dejar una reseña.</p>
@endif

<!-- Mostrar las reseñas aprobadas -->
@if($resenas->isEmpty())
    <p>No hay reseñas para este producto.</p>
@else
    <ul>
        @foreach($resenas as $resena)
        <li>
            <p><strong>{{ $resena->user->name }}</strong> ({{ $resena->calificacion }} / 5)</p>
            <p>{{ $resena->comentario }}</p>
        </li>
        @endforeach
    </ul>
@endif
@endsection
