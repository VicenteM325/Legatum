<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PanelsController\AdminController;
use App\Http\Controllers\PanelsController\AyudanteController;
use App\Http\Controllers\PanelsController\AuditorController;
use App\Http\Controllers\PanelsController\ConsultorController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Redirigir al dashboard según el rol
    Route::get('/dashboard', [DashboardController::class, 'redirectToDashboard'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/panels/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/panels/ayudante/dashboard', [AyudanteController::class, 'dashboard'])->name('ayudante.dashboard');
    Route::get('/panels/auditor/dashboard', [AuditorController::class, 'dashboard'])->name('auditor.dashboard');
    Route::get('/panels/consultor/dashboard', [ConsultorController::class, 'dashboard'])->name('consultor.dashboard');
    
});
