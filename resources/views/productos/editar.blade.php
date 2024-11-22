<form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Campos del formulario -->
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
