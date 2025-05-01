@extends('adminlte::page')

@section('title', 'Editar Contrato')

@section('content_header')
    <h1>Editar Contrato</h1>
@stop

@section('content')
    <form action="{{ route('contratos.update', $contrato) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nicho_id">Nicho</label>
            <select name="nicho_id" class="form-control" required>
                @foreach ($nichos as $nicho)
                    <option value="{{ $nicho->id }}" {{ $contrato->nicho_id == $nicho->id ? 'selected' : '' }}>
                        {{ $nicho->codigo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" name="monto" class="form-control" value="{{ $contrato->monto }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $contrato->fecha_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ $contrato->fecha_fin }}" required>
        </div>

        <div class="form-group">
            <label for="gracia">Período de Gracia (Meses)</label>
            <input type="number" name="gracia" class="form-control" value="{{ $contrato->gracia }}">
        </div>

         <!-- Selección de Ocupante -->
         <div class="form-group">
                <label for="ocupante_id">Ocupante:</label>
                <select name="ocupante_id" id="ocupante_id" class="form-control" required>
                    @foreach($ocupantes as $ocupante)
                        <option value="{{ $ocupante->id }}" {{ $contrato->ocupante_id == $ocupante->id ? 'selected' : '' }}>{{ $ocupante->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de Responsable -->
            <div class="form-group">
                <label for="responsable_id">Responsable:</label>
                <select name="responsable_id" id="responsable_id" class="form-control" required>
                    @foreach($responsables as $responsable)
                        <option value="{{ $responsable->id }}" {{ $contrato->responsable_id == $responsable->id ? 'selected' : '' }}>{{ $responsable->nombre }}</option>
                    @endforeach
                </select>
            </div>

        <button type="submit" class="btn btn-primary">Actualizar Contrato</button>
        <a href="{{ route('contratos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
