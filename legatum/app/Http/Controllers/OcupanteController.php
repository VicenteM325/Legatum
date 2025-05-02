<?php

namespace App\Http\Controllers;

use App\Models\Ocupante;
use App\Models\Nicho;
use App\Models\Responsable;
use Illuminate\Http\Request;

class OcupanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver_ocupantes')->only(['index', 'show']);
        $this->middleware('permission:crear_ocupantes')->only(['create', 'store']);
        $this->middleware('permission:editar_ocupantes')->only(['edit', 'update']);
        $this->middleware('permission:eliminar_ocupantes')->only(['destroy']);
    }

    public function create()
    {
        $nichos = Nicho::all();
        $responsables = Responsable::all();
        return view('ocupantes.create', compact('nichos', 'responsables'));
    }

    // Guardar un nuevo ocupante
        public function store(Request $request)
        {
            $request->validate([
                'nombre' => 'required',
                'apellidos' => 'required',
                'dpi' => 'required|unique:ocupantes,dpi',
                'procedencia' => 'required',
                'fecha_nacimiento' => 'required|date',
            ]);

            Ocupante::create($request->all());



            return redirect()->route('ocupantes.index');
        }

    // Listar todos los ocupantes
    public function index()
    {
        $ocupantes = Ocupante::all();
        return view('ocupantes.index', compact('ocupantes'));
    }

    // Mostrar formulario para editar un ocupante
    public function edit(Ocupante $ocupante)
    {
        return view('ocupantes.edit', compact('ocupante'));
    }

    // Actualizar ocupante
    public function update(Request $request, Ocupante $ocupante)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'dpi' => 'required',
            'procedencia' => 'required',
        ]);

        $ocupante->update($request->all());

        return redirect()->route('ocupantes.index');
    }

    // Eliminar ocupante
    public function destroy(Ocupante $ocupante)
    {
        $ocupante->delete();
        return redirect()->route('ocupantes.index');
    }
    public function nicho()
    {
        return $this->belongsTo(Nicho::class);
    }   

}
