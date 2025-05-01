@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Panel Administrativo</h1>
@stop

@section('content')
<div class="row">
    <!-- Métricas -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <a href="{{ route('nichos.index') }}" style="text-decoration: none; color: inherit;">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalNichos }}</h3>
                <p>Total Nichos</p>
            </div>
            <div class="icon">
                <i class="fas fa-th-large"></i>
            </div>
        </div>
       </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
    <a href="{{ route('contratos.index') }}" style="text-decoration: none; color: inherit;">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalContratos }}</h3>
                <p>Total Contratos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-signature"></i>
            </div>
        </div>
    </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
    <a href="{{ route('pagos.index') }}" style="text-decoration: none; color: inherit;">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalPagos }}</h3>
                <p>Total Pagos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalExhumaciones }}</h3>
                <p>Total Exhumaciones</p>
            </div>
            <div class="icon">
                <i class="fas fa-procedures"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Estadísticas adicionales -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <a href="{{ route('ocupantes.index') }}" style="text-decoration: none; color: inherit;">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalOcupantes }}</h3>
                    <p>Total Ocupantes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
        <a href="{{ route('responsables.index') }}" style="text-decoration: none; color: inherit;">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalResponsables }}</h3>
                    <p>Total Responsables</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Accesos rápidos -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Accesos Rápidos</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-3">
                <a href="{{ route('contratos.create') }}" class="btn btn-success btn-block">
                    <i class="fas fa-file-signature"></i><br>Nuevo Contrato
                </a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="{{ route('nichos.create') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-th-large"></i><br>Crear Nicho
                </a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="{{ route('pagos.create', ['contratoId' => 1]) }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-file-invoice-dollar"></i><br>Generar Boleta
                </a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="{{ route('ocupantes.create') }}" class="btn btn-info btn-block">
                    <i class="fas fa-user-plus"></i><br>Registrar Ocupante
                </a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="{{ route('responsables.create') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-user-tie"></i><br>Registrar Responsable
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .small-box .icon {
            top: 10px;
            right: 10px;
        }
        .small-box h3 {
            font-size: 2.2rem;
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script> console.log("Dashboard cargado correctamente"); </script>
@stop
