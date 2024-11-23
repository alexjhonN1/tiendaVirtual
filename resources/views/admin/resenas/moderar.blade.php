@extends('layouts.admin')

@section('content')
<h1>Moderación de Reseñas</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($resenasPendientes->isEmpty())
    <p>No hay reseñas pendientes de aprobación.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Usuario</th>
                <th>Calificación</th>
                <th>Comentario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resenasPendientes as $resena)
            <tr>
                <td>{{ $resena->producto->nombre }}</td>
                <td>{{ $resena->user->name }}</td>
                <td>{{ $resena->calificacion }} / 5</td>
                <td>{{ $resena->comentario }}</td>
                <td>
                    <form action="{{ route('admin.resenas.aprobar', $resena) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Aprobar</button>
                    </form>
                    <form action="{{ route('admin.resenas.rechazar', $resena) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
