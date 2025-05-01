<?php

namespace App\Http\Controllers\PanelsController\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function dashboard()
    {
        return view('panels.auditor.dashboard');
    }
}