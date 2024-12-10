@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Columna izquierda: Información del cliente -->
        <div class="col-md-7">
            <h3 class="mb-4">Información del Cliente</h3>
            
            <!-- Formulario completo -->
            <form action="{{ route('admin.compra.procesar') }}" method="POST">
                @csrf
                
                <!-- Correo -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ingresa tu correo electrónico">
                </div>

                <!-- Información personal -->
                <h5>Información</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombres y Apellidos</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dni" class="form-label">Documento de Identidad</label>
                        <input type="text" class="form-control" id="dni" name="dni" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Dirección de la calle">
                    </div>
                </div>

                <!-- Departamento y distrito -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento" name="departamento" required>
                            <option selected disabled>Selecciona...</option>
                            <option value="Lima">Lima</option>
                            <option value="Arequipa">Arequipa</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="distrito" class="form-label">Distrito</label>
                        <input type="text" class="form-control" id="distrito" name="distrito" required>
                    </div>
                </div>

                <!-- Referencia -->
                <div class="mb-3">
                    <label for="referencia" class="form-label">Referencia (opcional)</label>
                    <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia cercana">
                </div>

                <!-- Método de envío -->
                <h5>Método de Envío</h5>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="recoger" value="Recoger en tienda" checked>
                        <label class="form-check-label" for="recoger">
                            Recoger en tienda (GRATIS)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="envio" id="domicilio" value="Envío a domicilio">
                        <label class="form-check-label" for="domicilio">
                            Envío a domicilio
                        </label>
                    </div>
                </div>

                <!-- Documento de facturación -->
                <h5>Documento de Facturación</h5>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="documento" id="boleta" value="Boleta" checked>
                        <label class="form-check-label" for="boleta">
                            Boleta
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="documento" id="factura" value="Factura">
                        <label class="form-check-label" for="factura">
                            Factura
                        </label>
                    </div>
                </div>

                <!-- Resumen del pedido -->
                <h3 class="mb-4">Resumen de Compra</h3>
                <div class="card p-3">
                    <div class="card-body">
                        <h5 class="card-title">Pago Seguro</h5>

                        <!-- Productos -->
                        @foreach ($carrito as $item)
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('storage/' . $item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="img-fluid me-3" style="width: 80px; height: auto;">
                            <div>
                                <p class="mb-1">{{ $item->producto->nombre }}</p>
                                <p class="mb-0">Cantidad: {{ $item->cantidad }}</p>
                                <p class="fw-bold">S/{{ number_format($item->producto->precio * $item->cantidad, 2) }}</p>
                            </div>
                        </div>
                        @endforeach

                        <!-- Subtotales -->
                        <div class="mb-3">
                            <p>Subtotal: <span class="fw-bold">S/{{ number_format($subtotal, 2) }}</span></p>
                            <p>Costo de envío: <span class="fw-bold">GRATIS</span></p>
                            <p>Total: <span class="fw-bold">S/{{ number_format($total, 2) }}</span></p>
                        </div>

                        <!-- Aceptar términos y pagar -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terminos" name="terminos" required>
                            <label class="form-check-label" for="terminos">
                                He leído y acepto los <a href="#">términos y condiciones</a>.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ir a Pagar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
