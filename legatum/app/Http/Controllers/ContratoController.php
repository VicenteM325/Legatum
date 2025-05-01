<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Nicho;
use App\Models\Ocupante;
use App\Models\Responsable;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    // Mostrar la lista de contratos
    public function index()
    {
        $contratos = Contrato::with('nicho', 'ocupante', 'responsable')->get();
        return view('contratos.index', compact('contratos'));
    }

    // Mostrar el formulario de creación de contrato
    public function create()
    {
        $nichos = Nicho::all(); 
        $ocupantes = Ocupante::all(); 
        $responsables = Responsable::all();
        $ocupantes = Ocupante::with('nicho')->get();
        $ocupantes = Ocupante::with('responsable')->get();
 

        return view('contratos.create', compact('nichos', 'ocupantes', 'responsables'));
    }

    // Guardar un nuevo contrato en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'ocupante_id' => 'required|exists:ocupantes,id',
            'responsable_id' => 'required|exists:responsables,id',
            'monto' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'gracia' => 'nullable|integer',
        ]);
    
        $ocupante = Ocupante::with('nicho')->findOrFail($request->ocupante_id);
    

        if (!$ocupante->nicho) {
            return back()->withErrors(['ocupante_id' => 'El ocupante seleccionado no tiene un nicho asociado.'])->withInput();
        }
    

        if ($ocupante->nicho->estado !== 'disponible') {
            return back()->withErrors(['nicho_id' => 'El nicho ya está ocupado o no está disponible para contrato.'])->withInput();
        }
    
        // Crear contrato
        Contrato::create([
            'nicho_id' => $ocupante->nicho->id,
            'ocupante_id' => $request->ocupante_id,
            'responsable_id' => $request->responsable_id,
            'monto' => $request->monto,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'gracia' => $request->gracia,
        ]);
    

        $ocupante->nicho->estado = 'ocupado';
        $ocupante->nicho->save();
    
        return redirect()->route('contratos.index')->with('success', 'Contrato creado correctamente.');
    }
    


    // Mostrar el contrato y los pagos asociados
    public function show(Contrato $contrato)
    {
        $contrato->load('pagos', 'ocupante.responsable', 'nicho');
        return view('contratos.show', compact('contrato'));
    }

    // Mostrar el formulario para editar un contrato
    public function edit(Contrato $contrato)
    {
        $nichos = Nicho::all();
        $ocupantes = Ocupante::all(); 
        $responsables = Responsable::all(); 

        return view('contratos.edit', compact('contrato', 'nichos', 'ocupantes', 'responsables'));
    }

    // Actualizar un contrato en la base de datos
    public function update(Request $request, Contrato $contrato)
    {
        $request->validate([
            'nicho_id' => 'required|exists:nichos,id',
            'ocupante_id' => 'required|exists:ocupantes,id', 
            'responsable_id' => 'required|exists:responsables,id',  
            'monto' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'gracia' => 'nullable|integer',
        ]);

        // Actualizar contrato
        $contrato->update([
            'nicho_id' => $request->nicho_id,
            'ocupante_id' => $request->ocupante_id,  
            'responsable_id' => $request->responsable_id,  
            'monto' => $request->monto,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'gracia' => $request->gracia,
        ]);

        return redirect()->route('contratos.index')->with('success', 'Contrato actualizado.');
    }

    // Eliminar un contrato
    public function destroy(Contrato $contrato)
    {
        if ($contrato->pagos()->count() > 0) {
            return back()->withErrors(['error' => 'No se puede eliminar el contrato porque tiene pagos pendientes.']);
        }
    
        $contrato->delete();
    
        return redirect()->route('contratos.index')->with('success', 'Contrato eliminado.');
    }
    
}
