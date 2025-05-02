<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\NichoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\OcupanteController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PanelsController\Admin\UserController;
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


    //Contratos
    Route::resource('contratos', ContratoController::class);


    //Nichos
    Route::middleware('permission:ver_nichos')->group(function () {
        Route::get('/nichos', [NichoController::class, 'index']);
        Route::get('/nichos/{nicho}', [NichoController::class, 'show']);
    });
    
    Route::middleware('permission:crear_nichos')->group(function () {
        Route::get('/nichos/create', [NichoController::class, 'create']);
        Route::post('/nichos', [NichoController::class, 'store']);
    });
    Route::resource('nichos', NichoController::class);

    //Ayudante
    Route::middleware(['permission:ver_nichos'])->group(function () {
        Route::get('/nichos', [NichoController::class, 'index'])->name('nichos.index');
        Route::get('/nichos/{nicho}', [NichoController::class, 'show'])->name('nichos.show');
    });

    Route::middleware(['permission:crear_nichos'])->group(function () {
        Route::get('/nichos/create', [NichoController::class, 'create'])->name('nichos.create');
        Route::post('/nichos', [NichoController::class, 'store'])->name('nichos.store');
    });

    //Reportes
    Route::get('/ayudante/reportes', [ReporteController::class, 'index'])->name('ayudante.reportes');

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\PanelsController\Admin\UserController::class);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('admin/users', UserController::class);
    });
    Route::resource('admin/users', UserController::class)->names('admin.users');

    
});

