<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminResenaController;
use App\Http\Controllers\CategoriaController;
// Public Routes
Auth::routes();

// Admin Authentication Routes (public)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

// Admin Routes (protected by auth:admin)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes for roles and admins
    Route::resource('roles', RolesController::class);
    Route::resource('admins', AdminsController::class);

    // Rutas para gestión de productos
    Route::resource('productos', ProductoController::class)->names([
        'index' => 'productos.index',
        'create' => 'productos.create',
        'store' => 'productos.store',
        'edit' => 'productos.edit',
        'update' => 'productos.update',
        'destroy' => 'productos.destroy',
        'show' => 'productos.show',
    ]);

    // rutas para categorias 
<<<<<<< HEAD

    // Route::resource('categorias', CategoriaController::class)->names('admin.categorias');
    Route::resource('categorias', CategoriaController::class)->names([
=======
    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
        // Rutas para el CRUD de categorías
        Route::resource('categorias', CategoriaController::class)->names([
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f
            'index' => 'categorias.index',
            'create' => 'categorias.create',
            'store' => 'categorias.store',
            'show' => 'categorias.show',
            'edit' => 'categorias.edit',
            'update' => 'categorias.update',
            'destroy' => 'categorias.destroy',
<<<<<<< HEAD
    ]);
=======
        ]);
    });
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f

    // Ruta para la búsqueda de productos

    Route::get('admin/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');
    // ruta para carrito  de compras 

    Route::prefix('carrito')->name('carrito.')->middleware('auth')->group(function () {
        Route::get('/', [CarritoController::class, 'index'])->name('index');
        Route::post('/add/{producto}', [CarritoController::class, 'add'])->name('add');
        Route::patch('/update/{carrito}', [CarritoController::class, 'update'])->name('update');
        Route::delete('/remove/{carrito}', [CarritoController::class, 'destroy'])->name('destroy');
    });

    //ruta para las reseñas 

    Route::prefix('productos')->group(function () {
        Route::get('{producto}/resenas', [ProductoController::class, 'mostrarResenas'])->name('productos.resenas');
        Route::post('{producto}/resenas', [ProductoController::class, 'agregarResena'])->name('productos.resenas.agregar');
    });

    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
        Route::get('resenas/moderar', [AdminResenaController::class, 'moderarResenas'])->name('resenas.moderar');
        Route::patch('resenas/{resena}/aprobar', [AdminResenaController::class, 'aprobarResena'])->name('resenas.aprobar');
        Route::delete('resenas/{resena}/rechazar', [AdminResenaController::class, 'rechazarResena'])->name('resenas.rechazar');
    });
<<<<<<< HEAD

=======
    
    //ruta para cateogrias 

    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
        // Rutas de CRUD para Categorías
        Route::resource('categorias', CategoriaController::class)->names('categorias');
    });
    
    
    
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f

});
