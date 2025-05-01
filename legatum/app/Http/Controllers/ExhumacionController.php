<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhumacionController extends Controller
{
    public function create(Nicho $nicho)
{
    return view('exhumaciones.create', compact('nicho'));
}

public function store(Request $request, Nicho $nicho)
{
    Exhumacion::create([
        'nicho_id' => $nicho->id,
        'motivo' => $request->motivo,
        'solicitante' => $request->solicitante,
    ]);
    $nicho->update(['estado' => 'en_exhumacion']);
    return redirect()->route('nichos.index');
}

}
