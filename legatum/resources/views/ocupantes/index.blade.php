@extends('adminlte::page')

@section('title', 'Listado de Ocupantes')

@section('content_header')
    <h1>Listado de Ocupantes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DPI</th>
                        <th>Responsable</th>
                        <th>DPI-Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ocupantes as $ocupante)
                        <tr>
                            <td>{{ $ocupante->nombre }}</td>
                            <td>{{ $ocupante->apellidos }}</td>
                            <td>{{ $ocupante->dpi }}</td>
                            <td>{{ $ocupante->responsable->nombre ?? 'No asignado' }}</td> 
                            <td>{{ $ocupante->responsable->dpi ?? 'No asignado' }}</td> 
                            <td>
                                <a href="{{ route('ocupantes.edit', $ocupante) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('ocupantes.destroy', $ocupante) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
