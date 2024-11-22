<form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Campos del formulario -->
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
