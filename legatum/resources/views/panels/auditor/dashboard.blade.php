@extends('adminlte::page')

@section('title', 'Panel de Auditor')

@section('content_header')
    <h1 class="text-center"><i class="fas fa-user-shield mr-2"></i>Panel de Auditor</h1>
@stop

@section('content')
<div class="row">
    <!-- Métricas operativas -->
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $nichos}}</h3>
                <p>Información de Nichos</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('nichos.index', ['estado']) }}" class="small-box-footer">
                Ver listado <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pagos }}</h3>
                <p>Información Pagos</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('pagos.index', ['estado']) }}" class="small-box-footer">
                Ver pagos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalContratos }}</h3>
                <p>Contratos</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
            <a href="{{ route('contratos.index') }}" class="small-box-footer">
                Ver Contratos<i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Q{{ number_format($dineroRecaudado, 2) }}</h3>
                <p>Dinero Recaudado</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $proximosAVencer->count() }}</h3>
                <p>Contratos Próximos a Vencer</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-times"></i>
            </div>
            <a href="#contratos-proximos" class="small-box-footer">
                Ver listado <i class="fas fa-arrow-circle-down"></i>
            </a>
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
<div class="row mt-4" id="contratos-proximos">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i>Contratos Próximos a Vencer</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Fin</th>
                            <th>Ocupante</th>
                            <th>Nicho</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proximosAVencer as $contrato)
                        <tr>
                            <td>#{{ $contrato->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('d/m/Y') }}</td>
                            <td>{{ optional($contrato->ocupante)->nombre ?? 'N/D' }}</td>
                            <td>{{ optional($contrato->nicho)->codigo ?? 'N/D' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted text-center">No hay contratos próximos a vencer.</td>
                        </tr>
                        @endforelse
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