@extends('adminlte::page')

@section('title', 'Boleta de Pago')

@section('content_header')
    <h1>Boleta de Pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="mb-4">
                <h3><strong>Número de Boleta:</strong> {{ $pago->numero_boleta }}</h3>
                <p><strong>Contrato ID:</strong> {{ $contrato->id }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge {{ strtolower($pago->estado) === 'pagada' ? 'bg-success' : 'bg-warning' }}">
                        {{ $pago->estado }}
                    </span>
                </p>
                <p><strong>Fecha de Emisión:</strong> {{ $pago->created_at->format('d/m/Y') }}</p>
            </div>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Concepto</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Contrato #{{ $contrato->id }} - Nicho {{ $contrato->nicho->codigo ?? 'N/A' }}</td>
                        <td>Q{{ number_format($contrato->monto, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            @if(strtolower($pago->estado) === 'no pagada') 
                <form action="{{ route('pagos.confirmar', $pago->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Subir Comprobante de Pago:</label>
                        <input type="file" name="comprobante" id="comprobante" class="form-control" accept="image/*,application/pdf">
                    </div>

                    <button type="submit" class="btn btn-success">
                        Confirmar como Pagada
                    </button>
                </form>
            @else
                @if($pago->imagen_comprobante)
                    <div class="mt-4">
                        <strong>Comprobante:</strong><br>
                        <a href="{{ asset('storage/' . $pago->imagen_comprobante) }}" target="_blank">Ver Comprobante</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>
@stop

@section('css')
    <style>
        .badge {
            font-size: 1em;
            padding: 0.5em 1em;
        }
    </style>
@stop

@section('js')
    <script> console.log("Boleta de pago renderizada."); </script>
@stop
