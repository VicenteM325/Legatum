<?php

namespace App\Http\Controllers\PanelsController\Consultor;

use App\Models\Nicho;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Exhumacion;
use App\Models\Ocupante; 
use App\Models\Responsable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultorController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isConsultor()) {
            abort(403, 'Acceso no autorizado.');
        }
        // Estadísticas principales
        $nichosDisponibles = Nicho::where('estado', 'disponible')->count();
        $pagosPendientes = Pago::where('estado', 'pendiente')->count();
        $ocupantes = Ocupante::count();


        // Últimos registros
        $ultimosNichos = Nicho::latest()->take(5)->get(['codigo', 'calle', 'avenida', 'estado']);
        $ultimosPagos = Pago::with('contrato')->latest()->take(5)->get(['id', 'contrato_id', 'created_at']);


        return view('panels.consultor.dashboard', compact(
            'nichosDisponibles',
            'pagosPendientes',
            'ocupantes',
            'ultimosNichos',
            'ultimosPagos'
        ));
    }
}