<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nicho;
use App\Models\Pago;
use App\Models\Contrato;
use App\Models\Ocupante;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Nicho::query();
    
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
    
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
    
        if ($request->filled('estado_nicho')) {
            $query->where('estado', $request->estado_nicho);
        }
    
        if ($request->filled('historico')) {
            $query->where('es_historico', $request->historico);
        }
    
        if ($request->filled('estado_pago')) {
            $query->whereHas('contratos.pagos', function ($q) use ($request) {
                $q->where('estado', $request->estado_pago);
            });
        }
        
    
        $resultados = $query->orderBy('created_at', 'desc')->take(50)->get();
        $ocupadosFiltrados = $resultados->where('estado', 'ocupado')->count();
        $disponiblesFiltrados = $resultados->where('estado', 'disponible')->count();
        
        return view('panels.ayudante.reportes', compact(
            'resultados',
            'ocupadosFiltrados',
            'disponiblesFiltrados'
        ));
    }
}
