@extends('adminlte::page')

@section('title', 'Registrar Ocupante')

@section('content_header')
    <h1>Registrar Ocupante</h1>
@stop

@section('content')

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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('ocupantes.store') }}" method="POST" id="ocupanteForm">
                @csrf

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" required id="fecha_nacimiento">
                </div>

                <div class="form-group">
                    <label for="fecha_fallecimiento">Fecha de Fallecimiento:</label>
                    <input type="date" name="fecha_fallecimiento" class="form-control">
                </div>



                <div class="form-group">
                    <label for="nicho_id">Nicho:</label>
                    <select name="nicho_id" id="nicho_id" class="form-control" required>
                        <option value="">Seleccione un nicho</option>
                        @foreach($nichos as $nicho)
                            <option value="{{ $nicho->id }}" data-tipo="{{ $nicho->tipo }}">
                                {{ $nicho->codigo ?? 'Nicho ' . $nicho->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="responsable_id">Responsable:</label>
                    <select name="responsable_id" class="form-control">
                        <option value="">Seleccione un responsable</option>
                        @foreach($responsables as $responsable)
                            <option value="{{ $responsable->id }}">{{ $responsable->nombre }} - DPI: {{ $responsable->dpi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="dpi">DPI:</label>
                    <input type="text" name="dpi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="procedencia">Procedencia:</label>
                    <input type="text" name="procedencia" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="causa_muerte">Causa de Muerte:</label>
                    <input type="text" name="causa_muerte" class="form-control">
                </div>

                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select name="genero" class="form-control">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Registrar Ocupante</button>
            </form>
        </div>
    </div>

    <script>
        // Función para calcular la edad a partir de la fecha de nacimiento
        function calcularEdad(fechaNacimiento) {
            const nacimiento = new Date(fechaNacimiento);
            const hoy = new Date();
            let edad = hoy.getFullYear() - nacimiento.getFullYear();
            const m = hoy.getMonth() - nacimiento.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
                edad--;
            }
            return edad;
        }

        // Manejar la selección de fecha de nacimiento
        document.getElementById('fecha_nacimiento').addEventListener('change', function() {
            const fechaNacimiento = this.value;
            const edad = calcularEdad(fechaNacimiento);

            // Filtrar los nichos según la edad
            const nichos = document.querySelectorAll('#nicho_id option');
            nichos.forEach(function(nicho) {
                const tipo = nicho.getAttribute('data-tipo');

                if (edad < 18) {
                    // Mostrar solo los nichos para niños
                    if (tipo !== 'niño') {
                        nicho.style.display = 'none';
                    } else {
                        nicho.style.display = 'block';
                    }
                } else {
                    // Mostrar solo los nichos para adultos
                    if (tipo !== 'adulto') {
                        nicho.style.display = 'none';
                    } else {
                        nicho.style.display = 'block';
                    }
                }
            });
        });
    </script>

@stop
