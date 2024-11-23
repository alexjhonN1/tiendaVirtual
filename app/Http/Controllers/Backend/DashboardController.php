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
            'total_items_carrito' => Carrito::sum('cantidad'), // Total de ítems en el carrito
        ];

        // Retorna la vista con los datos
        return view('backend.pages.dashboard.index', $totals);
    }
}
