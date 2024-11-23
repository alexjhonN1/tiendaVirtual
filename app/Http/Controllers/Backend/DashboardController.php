<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Carrito; // Asegúrate de tener este modelo
use Illuminate\Contracts\Support\Renderable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(): Renderable
    {
        // Verifica permisos de acceso
        $this->checkAuthorization(['dashboard.view']);

        // Calcula los totales
        $totals = [
            'total_admins' => Admin::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'total_productos' => Producto::count(),
            'total_categorias' => Categoria::count(),
<<<<<<< HEAD
            'total_items_carrito' => Carrito::sum('cantidad'),
            'total_carrito' => Carrito::count(), 
=======
            'total_items_carrito' => Carrito::sum('cantidad'), // Total de ítems en el carrito
>>>>>>> 2aa955b58c8d15213ee1cd193c1d57c295f2e56f
        ];

        // Retorna la vista con los datos
        return view('backend.pages.dashboard.index', $totals);
    }
}
