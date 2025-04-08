<?php

namespace App\Http\Controllers\PanelsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyudanteController extends Controller
{
    public function dashboard()
    {
        return view('panels.ayudante.dashboard');
    }
}