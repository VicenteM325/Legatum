@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Registrar Exhumación para el Nicho: {{ $nicho->codigo }}</h2>
    <form action="{{ route('exhumaciones.store', $nicho->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="motivo">Motivo de Exhumación:</label>
            <textarea class="form-control" id="motivo" name="motivo" required></textarea>
        </div>
        <div class="form-group">
            <label for="solicitante">Nombre del Solicitante:</label>
            <input type="text" class="form-control" id="solicitante" name="solicitante" required>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Registrar Exhumación</button>
    </form>
</div>
@endsection
