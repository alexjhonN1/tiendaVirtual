@extends('layouts.navbar')

@section('content')
    <h1>Dashboard del Administrador</h1>
        <!-- Nueva tarjeta para Productos -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">Gestiona los productos disponibles en el sistema.</p>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-light">Ver Productos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
