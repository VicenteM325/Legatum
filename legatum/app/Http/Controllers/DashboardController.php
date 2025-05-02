<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function redirectToDashboard()
    {

            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
        
            if (auth()->user()->isAssistant()) {
                return redirect()->route('ayudante.dashboard');
            }
            if (auth()->user()->isAuditor()) {
                return redirect()->route('auditor.dashboard');
            }
            if (auth()->user()->isConsultor()) {
                return redirect()->route('consultor.dashboard');
            }
            abort(403, 'Rol no autorizado');
    }
}