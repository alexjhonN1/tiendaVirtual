@extends('layouts.navbar')


@section('content')
<div class="container">
    <h1>Dashboard del Personal</h1>

    
    <a href="{{ route('legajo.create') }}" class="btn btn-primary">Subir Legajo o actualizar</a>


</div>
@endsection
