@extends('adminlte::page')

@section('title', 'Registrar Responsable')

@section('content_header')
    <h1>Registrar Responsable</h1>
@stop

@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
        @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('responsables.store') }}" method="POST">
                @csrf
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
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrar Responsable</button>
            </form>
        </div>
    </div>
@stop
