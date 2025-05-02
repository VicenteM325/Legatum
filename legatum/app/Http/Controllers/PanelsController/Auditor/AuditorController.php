<?php

namespace App\Http\Controllers\PanelsController\Auditor;

use App\Models\Nicho;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Exhumacion;
use App\Models\Ocupante; 
use App\Models\Responsable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuditorController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isAuditor()) {
            abort(403, 'Acceso no autorizado.');
        }
        // Estadísticas principales
        $nichos = Nicho::count();
        $pagos = Pago::count();
        $ocupantes = Ocupante::count();
        $totalContratos = Contrato::count(); 

        // Últimos registros
        $ultimosNichos = Nicho::latest()->take(5)->get(['codigo', 'calle', 'avenida', 'estado']);
        $ultimosPagos = Pago::with('contrato')->latest()->take(5)->get(['id', 'contrato_id', 'created_at']);

        //Total Recaudado
        $dineroRecaudado = Pago::where('estado', 'pagado')
        ->with('contrato')
        ->get()
        ->unique('contrato_id') 
        ->sum(function ($pago) {
            return $pago->contrato ? $pago->contrato->monto : 0;
        });

        //Contratos proximos a vencer (30 dias)
        $proximosAVencer = Contrato::whereDate('fecha_fin', '<=', Carbon::now()->addDays(30))
        ->orderBy('fecha_fin')
        ->take(5)
        ->get();

        return view('panels.auditor.dashboard', compact(
            'nichos',
            'pagos',
            'ocupantes',
            'ultimosNichos',
            'ultimosPagos',
            'totalContratos', 'dineroRecaudado',
            'proximosAVencer'
        ));
    }
}