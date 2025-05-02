<?php


namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver_pagos')->only(['index', 'show']);
        $this->middleware('permission:crear_pagos')->only(['create', 'store']);
        $this->middleware('permission:editar_pagos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar_pagos')->only(['destroy']);
    }

    public function index()
    {
    $pagos = Pago::all(); 
    return view('pagos.index', compact('pagos'));
    }

    // Mostrar el formulario de creación de pago
    public function create()
    {
        $contratos = Contrato::all();
        return view('pagos.create', compact('contratos'));
    }

    // Guardar el pago en la base de datos
    public function store(Request $request)
{
    $request->validate([
        'contrato_id' => 'required|exists:contratos,id',
        'comprobante' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $pago = Pago::create([
        'contrato_id' => $request->input('contrato_id'),
        'numero_boleta' => 'BOL-' . now()->format('YmdHis') . '-' . uniqid(),
        'estado' => 'No pagada',
        'imagen_comprobante' => $request->file('comprobante') 
        ? $request->file('comprobante')->store('comprobantes', 'public') 
        : null,
    ]);
    

    return redirect()->route('pagos.show', $pago->id)->with('success', 'Boleta generada correctamente.');

}
        public function boleta(Pago $pago)
        {
            $contrato = $pago->contrato;

        return view('pagos.boleta', compact('pago', 'contrato'));
        }

        public function confirmar(Request $request, Pago $pago)
        {
            $request->validate([
                'comprobante' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
        
            if ($request->hasFile('comprobante')) {
                if ($pago->imagen_comprobante && \Storage::disk('public')->exists($pago->imagen_comprobante)) {
                    \Storage::disk('public')->delete($pago->imagen_comprobante);
                }
                $pago->imagen_comprobante = $request->file('comprobante')->store('comprobantes', 'public');
            }
            $pago->estado = 'Pagada';
            $pago->save();
        
            return redirect()->route('pagos.boleta', $pago->id)->with('success', 'Pago confirmado y comprobante guardado.');
        }
        
        
    public function updateEstado($id)
    {
        $pago = Pago::findOrFail($id);
    
        $pago->estado = ($pago->estado === 'Pagada') ? 'No pagada' : 'Pagada';
        $pago->save();

        return redirect()->route('pagos.index')->with('success', 'Estado del pago actualizado correctamente.');
    }
    
    // Mostrar los detalles del pago
    public function show($pagoId)
    {
        $pago = Pago::findOrFail($pagoId); 
        $contrato = $pago->contrato; 


        return view('pagos.show', compact('pago', 'contrato'));
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
    
}
