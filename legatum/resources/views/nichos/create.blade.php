@extends('adminlte::page')

@section('title', 'Crear Nuevo Nicho')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm border-left border-success">
        <h1 class="m-0 text-dark">
            <i class="fas fa-tombstone-alt text-gray mr-2"></i>
            <span class="font-weight-bold">Registrar Nuevo Nicho</span>
        </h1>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
             <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>
@stop


   
@section('content')
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="m-0 text-dark">
                            <i class="fas fa-info-circle text-gray mr-2"></i>
                            Complete los datos del nicho
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('nichos.store') }}" method="POST" id="nichoForm">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger border-left-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h6 class="font-weight-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>Corrige los siguientes errores:
                                    </h6>
                                    <ul class="mb-0 pl-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Sección Ubicación -->
                            <div class="form-section mb-4 border-left border-info">
                                <h5 class="section-title text-info mb-3">
                                    <i class="fas fa-map-marked-alt mr-2"></i>Ubicación del Nicho
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Calle</label>
                                            <input type="text" name="calle" class="form-control" placeholder="Ej: 3" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Avenida</label>
                                            <input type="text" name="avenida" class="form-control" placeholder="Ej: 5" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sección Características -->
                            <div class="form-section mb-4 border-left border-warning">
                                <h5 class="section-title text-warning mb-3">
                                    <i class="fas fa-tags mr-2"></i>Características
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tipo</label>
                                            <select name="tipo" class="form-control" required>
                                                <option value="" disabled selected>Seleccione tipo...</option>
                                                <option value="adulto">Adulto</option>
                                                <option value="niño">Niño</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Estado</label>
                                            <select name="estado" class="form-control" required>
                                                <option value="" disabled selected>Seleccione estado...</option>
                                                <option value="disponible">Disponible</option>
                                                <option value="ocupado">Ocupado</option>
                                                <option value="en proceso de exhumación">En proceso de exhumación</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="font-weight-bold">¿Es histórico?</label>
                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="es_historico" value="0">
                                             <input type="checkbox" class="custom-control-input" id="es_historico" name="es_historico" value="1">
                                        <label class="custom-control-label" for="es_historico">Marcar como nicho histórico</label>
                                    </div>
                                </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-save mr-2"></i> Registrar Nicho
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
    <style>
        .card {
            border-radius: 8px;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
        }
        .form-section {
            padding: 20px;
            margin-bottom: 25px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        .border-left {
            border-left-width: 4px !important;
        }
        .section-title {
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 1px dashed #dee2e6;
            padding-bottom: 8px;
        }
        .btn-lg {
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 0.5rem 2rem;
            transition: all 0.3s;
        }
        .btn-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .custom-switch {
            padding-left: 2.5rem;
        }
        .custom-control-label::before {
            left: -2.5rem;
        }
        .custom-control-label::after {
            left: -2.5rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Validación básica del formulario
            $('#nichoForm').on('submit', function(e) {
                let isValid = true;
                $(this).find('[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor complete todos los campos requeridos');
                }
            });
        });
    </script>
@stop


