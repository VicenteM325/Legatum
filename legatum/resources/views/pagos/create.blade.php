@extends('adminlte::page')

@section('title', 'Generar Boleta de Pago')

@section('content_header')
    <h1 class="text-center font-weight-bold">Generar Boleta de Pago</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">Seleccione el contrato</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('pagos.store') }}" method="POST">
                            @csrf

                            <!-- Selección de Contrato -->
                            <div class="form-group">
                                <label for="contrato_id" class="font-weight-bold">Contrato:</label>
                                <select name="contrato_id" id="contrato_id" class="form-control select2" required>
                                    <option value="" disabled selected>Seleccione un contrato...</option>
                                    @foreach($contratos as $contrato)
                                        <option value="{{ $contrato->id }}">
                                            Contrato #{{ $contrato->id }} - 
                                            {{ $contrato->responsable->nombre ?? 'Sin responsable' }} 
                                            (DPI: {{ $contrato->responsable->dpi ?? 'N/A' }}) - 
                                            Monto: Q{{ number_format($contrato->monto, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-arrow-left mr-2"></i> Volver
                                </a>
                                
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i> Generar Boleta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .card {
            border-radius: 10px;
        }
        .btn-lg {
            padding: 0.5rem 1.5rem;
            font-size: 1.1rem;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccione un contrato",
                allowClear: true
            });
            
            console.log("Formulario para generar boleta de pago listo.");
        });
    </script>
@stop