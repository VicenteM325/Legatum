@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Detalle del Contrato #{{ $contrato->id }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nicho:</strong> {{ $contrato->nicho->codigo }} ({{ $contrato->nicho->calle ?? 'Ubicación no disponible' }}-{{ $contrato->nicho->avenida ?? 'Ubicación no disponible' }})</p>
            <p><strong>Ocupante:</strong> {{ $contrato->ocupante->nombre ?? 'N/A' }} - DPI: {{ $contrato->ocupante->dpi ?? 'N/A' }}</p>
            <p><strong>Responsable:</strong> {{ $contrato->ocupante->responsable->nombre ?? 'N/A' }} - DPI: {{ $contrato->ocupante->responsable->dpi ?? 'N/A' }}</p>
            <p><strong>Monto:</strong> Q/ {{ number_format($contrato->monto, 2) }}</p>
            <p><strong>Fecha de Inicio:</strong> {{ $contrato->fecha_inicio }}</p>
            <p><strong>Fecha de Fin:</strong> {{ $contrato->fecha_fin }}</p>
            <p><strong>Gracia:</strong> {{ $contrato->gracia ?? 'N/A' }} meses</p>
        </div>
    </div>

    <h4>Boletas de Pago</h4>
    @if ($contrato->pagos->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Número de Boleta</th>
                    <th>Estado</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contrato->pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->numero_boleta }}</td>
                        <td>
                            @if ($pago->estado === 'pagada')
                                <span class="badge bg-success">Pagada</span>
                            @else
                                <span class="badge bg-warning text-dark">No Pagada</span>
                            @endif
                        </td>
                        <td>
                            @if ($pago->imagen_comprobante)
                                <a href="{{ asset('storage/' . $pago->imagen_comprobante) }}" target="_blank">Ver comprobante</a>
                            @else
                                <em>Sin comprobante</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay boletas registradas para este contrato.</p>
    @endif

    <a href="{{ route('contratos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
