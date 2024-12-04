<!-- sidebar menu area start -->
@php
    $usr = Auth::guard('admin')->user();
@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Software Team</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') && $usr->can('role.view') && $usr->can('role.edit') && $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            categorias
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.categorias.create') || Route::is('admin.categorias.index') || Route::is('admin.categorias.edit') || Route::is('admin.categorias.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.categorias.index') || Route::is('admin.categorias.edit') ? 'active' : '' }}"><a href="{{ route('admin.categorias.index') }}">Crear categoria</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') && $usr->can('role.view') && $usr->can('role.edit') && $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            productos
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.productos.create') || Route::is('admin.productos.index') || Route::is('admin.productos.edit') || Route::is('admin.productos.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.productos.index') || Route::is('admin.productos.edit') ? 'active' : '' }}"><a href="{{ route('admin.productos.index') }}">Crear productos</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') && $usr->can('role.view') && $usr->can('role.edit') && $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            carrito
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.carrito.create') || Route::is('admin.carrito.index') || Route::is('admin.carrito.edit') || Route::is('admin.carrito.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.carrito.index') || Route::is('admin.carrito.edit') ? 'active' : '' }}"><a href="{{ route('admin.carrito.index') }}">Carrito de Compras</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">
                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif
                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
