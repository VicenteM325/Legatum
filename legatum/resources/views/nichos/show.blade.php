@extends('adminlte::page')

@section('title', 'Detalle del Nicho')

@section('content_header')
    <h1><i class="fas fa-eye text-info mr-2"></i>Detalle del Nicho</h1>
@stop

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="m-0"><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Información del Nicho</h5>
            </div>
            <div class="card-body">
                <p><strong>Calle:</strong> {{ $nicho->calle }}</p>
                <p><strong>Avenida:</strong> {{ $nicho->avenida }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($nicho->tipo) }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($nicho->estado) }}</p>
                <p><strong>Histórico:</strong> {{ $nicho->es_historico ? 'Sí' : 'No' }}</p>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white">
                <h5 class="m-0"><i class="fas fa-user mr-2 text-secondary"></i> Ocupante</h5>
            </div>
            <div class="card-body">
                 @if ($nicho->ocupante)
                    <p><strong>Nombre:</strong> {{ $nicho->ocupante->nombre }} {{ $nicho->ocupante->apellidos }}</p>
                     <p><strong>DPI:</strong> {{ $nicho->ocupante->dpi }}</p>
                     <p><strong>Procedencia:</strong> {{ $nicho->ocupante->procedencia }}</p>
                     <p><strong>Fecha de Fallecimiento:</strong> {{ $nicho->ocupante->fecha_fallecimiento }}</p>
                     <p><strong>Causa de Muerte:</strong> {{ $nicho->ocupante->causa_muerte }}</p>
                    <p><strong>Género:</strong> {{ $nicho->ocupante->genero }}</p>
                 @else
        <p class="text-muted">No hay ocupante asignado a este nicho.</p>
    @endif
</div>


        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white">
                <h5 class="m-0"><i class="fas fa-user-shield mr-2 text-warning"></i> Responsable</h5>
            </div>
            <div class="card-body">
            @if ($nicho->ocupante && $nicho->ocupante->responsable)
                <p><strong>Nombre:</strong> {{ $nicho->ocupante->responsable->nombre }}</p>
                 <p><strong>DPI:</strong> {{ $nicho->ocupante->responsable->dpi }}</p>
                 <p><strong>Teléfono:</strong> {{ $nicho->ocupante->responsable->telefono }}</p>
                 <p><strong>Dirección:</strong> {{ $nicho->ocupante->responsable->direccion }}</p>
            @else
             <p class="text-muted">No hay responsable registrado para este nicho.</p>
            @endif

            </div>
        </div>

        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-header h5 {
            font-weight: 600;
        }
        .card-body p {
            margin-bottom: 0.5rem;
        }
    </style>
@stop
