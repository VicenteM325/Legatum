<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver_responsables')->only(['index', 'show']);
        $this->middleware('permission:crear_responsables')->only(['create', 'store']);
        $this->middleware('permission:editar_responsables')->only(['edit', 'update']);
        $this->middleware('permission:eliminar_responsables')->only(['destroy']);
    }

    public function create()
    {
        return view('responsables.create');
    }

    // Guardar un nuevo responsable
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'dpi' => 'required|unique:responsables,dpi',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
        ]);

        Responsable::create($request->all());

        return redirect()->route('responsables.index');
    }

    // Listar todos los responsables
    public function index()
    {
        $responsables = Responsable::all();
        return view('responsables.index', compact('responsables'));
    }

    // Mostrar formulario para editar un responsable
    public function edit(Responsable $responsable)
    {
        return view('responsables.edit', compact('responsable'));
    }

    // Actualizar responsable
    public function update(Request $request, Responsable $responsable)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'dpi' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
        ]);

        $responsable->update($request->all());

        return redirect()->route('responsables.index');
    }

    // Eliminar responsable
    public function destroy(Responsable $responsable)
    {
        $responsable->delete();
        return redirect()->route('responsables.index');
    }
}
