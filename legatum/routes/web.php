<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\NichoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\OcupanteController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\PanelsController\Admin\AdminController;
use App\Http\Controllers\PanelsController\Ayudante\AyudanteController;
use App\Http\Controllers\PanelsController\Auditor\AuditorController;
use App\Http\Controllers\PanelsController\Consultor\ConsultorController;

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

    Route::resource('nichos', NichoController::class);
    Route::resource('contratos', ContratoController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('exhumaciones', ExhumacionController::class);

    //Ocupantes y responsables
    Route::resource('ocupantes', OcupanteController::class);
    Route::resource('responsables', ResponsableController::class);

    //Pagos
    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('/pagos/create', [PagoController::class, 'create'])->name('pagos.create');
    Route::get('/pagos/{pagoId}', [PagoController::class, 'boleta'])->name('pagos.boleta');
    Route::put('/pagos/{pago}/confirmar', [PagoController::class, 'confirmar'])->name('pagos.confirmar');
    Route::get('/pagos/{pago}/boleta', [PagoController::class, 'boleta'])->name('pagos.boleta');
    Route::put('pagos/{pago}/update_estado', [PagoController::class, 'updateEstado'])->name('pagos.update_estado');


    //Route::get('pagos/generar-boleta/{contratoId}', [PagoController::class, 'generarBoleta'])->name('pagos.generarBoleta');
    //Route::get('pagos/ver-boleta/{pago}', [PagoController::class, 'verBoletaPDF'])->name('pagos.verBoletaPDF');


    //Contratos
    Route::resource('contratos', ContratoController::class);


    //Nichos
    Route::resource('nichos', NichoController::class);

    
});

