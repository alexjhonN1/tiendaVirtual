<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

class AdminResenaController extends Controller
{
    // Mostrar reseñas pendientes de aprobación
    public function moderarResenas()
    {
        $resenasPendientes = Resena::where('aprobado', false)->get();

        return view('admin.resenas.moderar', compact('resenasPendientes'));
    }

    // Aprobar una reseña
    public function aprobarResena(Resena $resena)
    {
        $resena->update(['aprobado' => true]);

        return back()->with('success', 'Reseña aprobada.');
    }

    // Rechazar una reseña 
    public function rechazarResena(Resena $resena)
    {
        $resena->delete();

        return back()->with('success', 'Reseña rechazada.');
    }
}
