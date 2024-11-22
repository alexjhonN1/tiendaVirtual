<a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear Producto</a>

@foreach($productos as $producto)
    <tr>
        <td>{{ $producto->nombre }}</td>
        <td>
            <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
@endforeach
