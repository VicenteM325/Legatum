@extends('adminlte::page')

@section('title', 'Crear Contrato')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary"><i class="fas fa-file-contract mr-2"></i>Crear Nuevo Contrato</h1>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
           <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-info-circle mr-2"></i>Información del Contrato</h3>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('contratos.store') }}" method="POST" id="contratoForm">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="fas fa-exclamation-triangle mr-2"></i>¡Error!</strong> Corrige los siguientes problemas:
                                    <ul class="mt-2 mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Sección Ocupante -->
                            <div class="form-section mb-4">
                                <h5 class="section-title text-primary mb-3">
                                    <i class="fas fa-user mr-2"></i>Datos del Ocupante
                                </h5>
                                
                                <div class="form-group">
                                    <label for="ocupante_id" class="font-weight-bold">Seleccionar Ocupante</label>
                                    <select name="ocupante_id" id="ocupante_id" class="form-control select2" required>
                                        <option value="">Buscar ocupante...</option>
                                        @foreach($ocupantes as $ocupante)
                                        <option 
                                            value="{{ $ocupante->id }}" 
                                            data-responsable-id="{{ $ocupante->responsable->id ?? '' }}"
                                            data-responsable-nombre="{{ $ocupante->responsable->nombre ?? 'Sin responsable' }}"
                                            data-responsable-dpi="{{ $ocupante->responsable->dpi ?? '' }}"
                                            data-nicho="{{ $ocupante->nicho->codigo ?? 'Sin código' }}"
                                        >
                                            {{ $ocupante->nombre }} - DPI: {{ $ocupante->dpi }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Responsable Asociado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-user-tie text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control bg-light" id="responsable_info" readonly>
                                            </div>
                                            <input type="hidden" name="responsable_id" id="responsable_id">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nicho Asociado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control bg-light" id="nicho_info" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sección de Contrato -->
                            <div class="form-section mb-4">
                                <h5 class="section-title text-primary mb-3">
                                    <i class="fas fa-file-signature mr-2"></i>Detalles del Contrato
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="monto" class="font-weight-bold">Monto Anual</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white">Q</span>
                                                </div>
                                                <input type="number" class="form-control" id="monto" name="monto" step="100" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gracia" class="font-weight-bold">Período de Gracia (meses)</label>
                                            <input type="number" class="form-control" id="gracia" name="gracia">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_inicio" class="font-weight-bold">Fecha de Inicio</label>
                                            <input type="date" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_fin" class="font-weight-bold">Fecha de Finalización</label>
                                            <input type="date" class="form-control datepicker" id="fecha_fin" name="fecha_fin" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                    <i class="fas fa-save mr-2"></i> Guardar Contrato
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
        .card {
            border-radius: 12px;
            border: none;
        }
        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }
        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #4e73df;
        }
        .section-title {
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 1px dashed #dee2e6;
            padding-bottom: 8px;
        }
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .btn-lg {
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .input-group-text {
            min-width: 40px;
            justify-content: center;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                placeholder: "Seleccione un ocupante",
                allowClear: true
            });

            // Manejar cambio de ocupante
            $('#ocupante_id').change(function() {
                const selectedOption = $(this).find('option:selected');
                const responsableNombre = selectedOption.data('responsable-nombre');
                const responsableDpi = selectedOption.data('responsable-dpi');
                const responsableId = selectedOption.data('responsable-id');
                const nicho = selectedOption.data('nicho');

                $('#responsable_info').val(responsableNombre 
                    ? `${responsableNombre} - DPI: ${responsableDpi}` 
                    : 'Sin responsable asociado');

                $('#responsable_id').val(responsableId || '');
                $('#nicho_info').val(nicho || 'Sin nicho asociado');
            });

            // Calcular fecha fin automáticamente
            $('#fecha_inicio').change(function() {
                const fechaInicio = new Date(this.value);

                if (!isNaN(fechaInicio.getTime())) {
                    const fechaFin = new Date(fechaInicio);
                    fechaFin.setFullYear(fechaFin.getFullYear() + 6);

                    const yyyy = fechaFin.getFullYear();
                    const mm = String(fechaFin.getMonth() + 1).padStart(2, '0');
                    const dd = String(fechaFin.getDate()).padStart(2, '0');
                    $('#fecha_fin').val(`${yyyy}-${mm}-${dd}`);

                    // Establecer gracia por defecto
                    $('#gracia').val(12);
                }
            });

            // Validación de formulario
            $('#contratoForm').on('submit', function(e) {
                const fechaInicio = new Date($('#fecha_inicio').val());
                const fechaFin = new Date($('#fecha_fin').val());
                
                if (fechaFin <= fechaInicio) {
                    alert('La fecha de finalización debe ser posterior a la fecha de inicio');
                    e.preventDefault();
                }
            });
        });
    </script>
@stop