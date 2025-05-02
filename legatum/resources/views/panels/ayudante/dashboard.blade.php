@extends('adminlte::page')

@section('title', 'Panel de Ayudante')

@section('content_header')
    <h1 class="text-center"><i class="fas fa-user-shield mr-2"></i>Panel de Ayudante</h1>
@stop

@section('content')
<div class="row">
    <!-- Métricas operativas -->
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $nichosDisponibles }}</h3>
                <p>Nichos Disponibles</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('nichos.index', ['estado' => 'disponible']) }}" class="small-box-footer">
                Ver listado <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pagosPendientes }}</h3>
                <p>Pagos Pendientes</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('pagos.index', ['estado' => 'pendiente']) }}" class="small-box-footer">
                Ver pendientes <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $ocupantes}}</h3>
                <p>Cantidad de Ocupantes</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
            <a href="{{ route('ocupantes.index', ['sin_responsable' => true]) }}" class="small-box-footer">
                Ver responsables <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Sección de acciones rápidas -->
<div class="card mt-4">
    <div class="card-header bg-light">
        <h3 class="card-title"><i class="fas fa-bolt mr-2"></i>Acciones Rápidas</h3>
    </div>
        <div class="col-md-3 mb-3">
             <a href="{{ route('ayudante.reportes') }}" class="btn btn-dark btn-block">
                <i class="fas fa-chart-bar fa-2x mb-2"></i><br>Ver Reportes
             </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('ocupantes.create') }}" class="btn btn-info btn-block">
                    <i class="fas fa-user-plus fa-2x mb-2"></i><br>Nuevo Ocupante
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('responsables.create') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-user-tie fa-2x mb-2"></i><br>Nuevo Responsable
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('contratos.create') }}" class="btn btn-success btn-block">
                     <i class="fas fa-file-signature fa-2x mb-2"></i><br>Nuevo Contrato
                 </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('pagos.create') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-file-invoice-dollar fa-2x mb-2"></i><br>Generar Boleta de Pago
                </a>
            </div>
           
        </div>
    </div>
</div>

<!-- Últimos registros -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fas fa-th-large mr-2"></i>Últimos Nichos Registrados</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ultimosNichos as $nicho)
                        <tr>
                            <td>{{ $nicho->codigo }}</td>
                            <td>Calle {{ $nicho->calle }}, Av. {{ $nicho->avenida }}</td>
                            <td>
                                <span class="badge bg-{{ $nicho->estado == 'disponible' ? 'success' : 'danger' }}">
                                    {{ ucfirst($nicho->estado) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fas fa-file-invoice-dollar mr-2"></i>Últimos Pagos Registrados</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Boleta</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ultimosPagos as $pago)
                        <tr>
                            <td>#{{ $pago->id }}</td>
                            <td>
                             @if($pago->contrato)
                                Q{{ number_format($pago->contrato->monto, 2) }}
                             @else
                                <span class="text-muted">Sin contrato</span>
                             @endif
                            </td>

                            <td>{{ $pago->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .small-box {
        cursor: pointer;
        transition: transform 0.3s;
    }
    .small-box:hover {
        transform: translateY(-5px);
    }
    .card-header.bg-light {
        background-color: #f8f9fa !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
</style>
@stop