@extends('adminlte::page')

@section('title', 'Listado de Pagos')

@section('content_header')
    <h1>Pagos Registrados</h1>
@stop

@section('content')
    {{-- Mostrar mensajes flash --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contrato</th>
                <th>Ocupante</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->id }}</td>

                    <!-- Info del contrato -->
                    <td>
                        {{ $pago->contrato ? 'Contrato #' . $pago->contrato->id : 'N/A' }}
                    </td>

                    <!-- Ocupante y Responsable -->
                    <td>{{ $pago->contrato->ocupante->nombre ?? 'No disponible' }}</td>
                    <td>
                        {{ $pago->contrato && $pago->contrato->responsable ? $pago->contrato->responsable->nombre : 'N/A' }}
                    </td>

                    <!-- Monto y Fecha -->
                    <td>Q{{ number_format($pago->contrato->monto, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>

                    <!-- Estado -->
                    <td>
                        <span class="badge {{ strtolower($pago->estado) === 'pagada' ? 'bg-success' : 'bg-warning' }}">
                            {{ $pago->estado }}
                        </span>
                    </td>

                    <!-- Acciones -->
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('pagos.boleta', $pago->id) }}" class="btn btn-info btn-sm" title="Ver boleta">
                                <i class="fas fa-eye"></i>
                            </a>

                            <form action="{{ route('pagos.update_estado', $pago->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn {{ strtolower($pago->estado) === 'pagada' ? 'btn-warning' : 'btn-success' }} btn-sm" title="{{ strtolower($pago->estado) === 'pagada' ? 'Marcar como no pagada' : 'Marcar como pagada' }}">
                                    <i class="fas {{ strtolower($pago->estado) === 'pagada' ? 'fa-times' : 'fa-check' }}"></i>
                                </button>
                            </form>

                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este pago?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .d-flex.gap-1 > * {
            margin-right: 0.25rem;
        }
        .btn-sm {
            width: 32px; /* Ancho fijo para los botones */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@stop