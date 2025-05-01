@extends('adminlte::page')

@section('title', 'Listado de Responsables')

@section('content_header')
    <h1>Listado de Responsables</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('responsables.create') }}" class="btn btn-success mb-3">Registrar Responsable</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DPI</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsables as $responsable)
                        <tr>
                            <td>{{ $responsable->nombre }}</td>
                            <td>{{ $responsable->apellidos }}</td>
                            <td>{{ $responsable->dpi }}</td>
                            <td>{{ $responsable->direccion }}</td>
                            <td>{{ $responsable->telefono }}</td>
                            <td>{{ $responsable->email }}</td>
                            <td>
                                <a href="{{ route('responsables.edit', $responsable) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('responsables.destroy', $responsable) }}" method="POST" style="display:inline;">
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
