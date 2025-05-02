<?php

namespace App\Http\Controllers\PanelsController\Ayudante;

use App\Models\Nicho;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Exhumacion;
use App\Models\Ocupante; 
use App\Models\Responsable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyudanteController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isAssistant()) {
            abort(403, 'Acceso no autorizado.');
        }
        // Estadísticas principales
        $nichosDisponibles = Nicho::where('estado', 'disponible')->count();
        $pagosPendientes = Pago::where('estado', 'pendiente')->count();
        $ocupantes = Ocupante::count();


        // Últimos registros
        $ultimosNichos = Nicho::latest()->take(5)->get(['codigo', 'calle', 'avenida', 'estado']);
        $ultimosPagos = Pago::with('contrato')->latest()->take(5)->get(['id', 'contrato_id', 'created_at']);


        return view('panels.ayudante.dashboard', compact(
            'nichosDisponibles',
            'pagosPendientes',
            'ocupantes',
            'ultimosNichos',
            'ultimosPagos'
        ));
    }
}