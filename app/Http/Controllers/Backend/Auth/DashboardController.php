<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //ACA ELEGIMOS A QUE DASHBOARD REDIRECCIONARA, EN SI ESTO FUNCIONA CON UN MIDDLEWARE PARA LA AUTENTICACION
    
    //DASHBOAR DEL ADMIN
    public function adminDashboard()
    {
        return view('admin.dashboard'); 
    }
    
    //DASBOARD DEL USER O EL PERSONAL MORTAL
    public function userDashboard()
    {
        return view('user.dashboard'); 
    }
}
