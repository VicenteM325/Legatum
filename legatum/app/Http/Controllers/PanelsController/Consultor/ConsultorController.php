<?php

namespace App\Http\Controllers\PanelsController\Consultor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultorController extends Controller
{
    public function dashboard()
    {
        return view('panels.consultor.dashboard');
    }
}