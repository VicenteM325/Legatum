@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Editar Nicho: {{ $nicho->codigo }}</h2>

    <form action="{{ route('nichos.update', $nicho) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="codigo">Código del Nicho</label>
            <input type="text" name="codigo" value="{{ $nicho->codigo }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="tipo">Tipo del Nicho</label>
            <select name="tipo" class="form-control" required>
                <option value="adulto">Adulto</option>
                <option value="niño">Niño</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="calle">Calle</label>
            <input type="text" name="calle" value="{{ $nicho->calle }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="avenida">Avenida</label>
            <input type="text" name="avenida" value="{{ $nicho->avenida }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="ocupado">Ocupado</option>
                <option value="en proceso de exhumación">En proceso de exhumación</option>
            </select>
        </div>

        <div class="form-group">
            <label for="es_historico">¿Es histórico?</label>
            <select name="es_historico" class="form-control" required>
                <option value="1" {{ $nicho->es_historico ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$nicho->es_historico ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Nicho</button>
    </form>
</div>
@endsection
