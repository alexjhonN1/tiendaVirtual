@extends('backend.layouts.master')

@section('title')
Dashboard Page - Admin Panel
@endsection

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
  <div class="row">
    <div class="col-lg-8">
        <div class="row">
            <!-- Tarjeta de Roles -->
            <div class="col-md-6 mt-5 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <a href="{{ route('admin.roles.index') }}">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-users"></i> Roles</div>
                                <h2>{{ $total_roles }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Admins -->
            <div class="col-md-6 mt-md-5 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <a href="{{ route('admin.admins.index') }}">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-user"></i> Admins</div>
                                <h2>{{ $total_admins }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Permissions -->
            <div class="col-md-6 mb-3 mb-lg-0">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">Permissions</div>
                            <h2>{{ $total_permissions }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nueva Tarjeta de Productos -->
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="seo-fact sbg4">
                        <a href="{{ route('admin.productos.index') }}">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-box"></i> Productos</div>
                                <h2>{{ $total_productos }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Fin de la Tarjeta de Productos -->
        </div>
    </div>
  </div>
</div>
@endsection
