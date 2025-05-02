<?php

namespace App\Http\Controllers\PanelsController\Admin;

use App\Models\Nicho;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Exhumacion;
use App\Models\Ocupante; 
use App\Models\Responsable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{       
    public function dashboard()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acceso no autorizado.');
        }
        // Se obtienen las estadísticas
        $totalNichos = Nicho::count();  
        $totalContratos = Contrato::count(); 
        $totalPagos = Pago::count(); 
        $totalExhumaciones = Exhumacion::count();
        $totalOcupantes = Ocupante::count();
        $totalResponsables = Responsable::count();
        $totalUsuarios = User::count();  

        return view('panels.admin.dashboard', compact(
            'totalNichos', 
            'totalContratos', 
            'totalPagos', 
            'totalExhumaciones',
            'totalOcupantes', 
            'totalResponsables',
            'totalUsuarios'
        ));
    }
}