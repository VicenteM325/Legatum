<?php

namespace App\Http\Controllers;

use App\Models\Nicho;
use Illuminate\Http\Request;

class NichoController extends Controller
{
    public function index()
{
    $nichos = Nicho::all();
    $callesUnicas = Nicho::select('calle')->distinct()->orderBy('calle')->pluck('calle');
    $avenidasUnicas = Nicho::select('avenida')->distinct()->orderBy('avenida')->pluck('avenida');
    
    return view('nichos.index', compact('nichos', 'callesUnicas', 'avenidasUnicas'));
}

    public function create()
    {
        $avenida = request('avenida');
        $calle = request('calle');
    
    return view('nichos.create', compact('avenida', 'calle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'calle' => 'required|string',
            'avenida' => 'required|string',
            'estado' => 'required|string',
            'es_historico' => 'required|boolean',
        ]);
    
        $existeNicho = Nicho::where('calle', $request->calle)
                            ->where('avenida', $request->avenida)
                            ->exists();
    
        if ($existeNicho) {
            return back()->withErrors(['mensaje' => 'Ya existe un nicho en esta calle y avenida.']);
        }
    
        $ultimoId = Nicho::max('id') ?? 0;
        $nuevoId = $ultimoId + 1;
        $codigo = 'NIC-' . str_pad($nuevoId, 3, '0', STR_PAD_LEFT) . '-A';
    
        // Crear el nuevo nicho
        Nicho::create([
            'codigo' => $codigo,
            'tipo' => $request->tipo,
            'calle' => $request->calle,
            'avenida' => $request->avenida,
            'estado' => $request->estado,
            'es_historico' => $request->es_historico,
        ]);
    
        return redirect()->route('nichos.index')->with('success', 'Nicho creado correctamente.');
    }
    

    public function show(Nicho $nicho)
    {
        return view('nichos.show', compact('nicho'));
    }
    

    public function edit(Nicho $nicho)
    {
        return view('nichos.edit', compact('nicho')); // Vista para editar un nicho
    }

    public function update(Request $request, Nicho $nicho)
    {
        $request->validate([
            'codigo' => 'required|unique:nichos,codigo,' . $nicho->id,
            'tipo' => 'required|string',
            'calle' => 'required|string',
            'avenida' => 'required|string',
            'estado' => 'required|string',
            'es_historico' => 'required|boolean',
        ]);

        $nicho->update($request->all()); // Actualizar el nicho

        return redirect()->route('nichos.index')->with('success', 'Nicho actualizado correctamente.');
    }

    public function destroy(Nicho $nicho)
    {
        $nicho->delete(); // Eliminar el nicho

        return redirect()->route('nichos.index')->with('success', 'Nicho eliminado correctamente.');
    }
    
}