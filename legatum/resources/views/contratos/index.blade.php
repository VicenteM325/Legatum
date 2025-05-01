@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <h1>Lista de Contratos</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{ route('contratos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Contrato</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nicho</th>
                <th>Monto</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Período de Gracia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->id }}</td>
                    <td>{{ $contrato->nicho->codigo ?? 'Sin código' }}</td>
                    <td>{{ $contrato->monto }}</td>
                    <td>{{ $contrato->fecha_inicio }}</td>
                    <td>{{ $contrato->fecha_fin }}</td>
                    <td>{{ $contrato->gracia }} meses</td>
                    <td>
                        <a href="{{ route('contratos.show', $contrato) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('contratos.edit', $contrato) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('contratos.destroy', $contrato) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
