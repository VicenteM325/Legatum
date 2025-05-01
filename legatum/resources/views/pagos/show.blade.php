@extends('adminlte::page')

@section('title', 'Boleta de Pago')

@section('content_header')
    <h1 class="text-center">Boleta de Pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4><strong>Número de Boleta:</strong> {{ $pago->numero_boleta }}</h4>
                    <p><strong>Fecha de Emisión:</strong> {{ $pago->created_at->format('d/m/Y') }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge {{ strtolower($pago->estado) === 'pagada' ? 'bg-success' : 'bg-warning' }}">
                            {{ $pago->estado }}
                        </span>
                    </p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Datos del Contrato</h5>
            <p><strong>ID Contrato:</strong> {{ $contrato->id }}</p>
            <p><strong>Responsable:</strong> {{ $contrato->responsable->nombre ?? 'N/A' }}</p>
            <p><strong>Ocupante:</strong> {{ $contrato->ocupante->nombre ?? 'N/A' }}</p>
            <p><strong>Nicho:</strong> {{ $contrato->nicho->codigo ?? 'N/A' }}</p>

            <hr>

            <h5 class="mb-3">Detalle del Pago</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th class="text-end">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cuota de contrato #{{ $contrato->id }}</td>
                        <td class="text-end">Q{{ number_format($contrato->monto, 2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th class="text-end">Q{{ number_format($contrato->monto, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            @if($pago->imagen_comprobante)
                <div class="mt-4">
                    <strong>Comprobante Subido:</strong><br>
                    <img src="{{ asset('storage/' . $pago->imagen_comprobante) }}" alt="Comprobante de Pago" class="img-thumbnail" width="300">
                </div>
            @else
                <p class="text-muted">No se ha subido ningún comprobante de pago.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('pagos.create', ['contratoId' => $contrato->id]) }}" class="btn btn-success">
                    Registrar Nuevo Pago
                </a>
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>
@stop

@section('css')
    <style>
        .badge {
            font-size: 1rem;
            padding: 0.5em 1em;
        }
    </style>
@stop

@section('js')
    <script> console.log("Boleta de pago detallada mostrada."); </script>
@stop
