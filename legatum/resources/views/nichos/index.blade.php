@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Administración de Nichos</h2>
    
    <a href="{{ route('nichos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Nicho</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pestañas -->
    <ul class="nav nav-tabs" id="nichosTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="table-tab" data-toggle="tab" href="#table-view" role="tab">Vista Tabla</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="map-tab" data-toggle="tab" href="#map-view" role="tab">Vista Mapa</a>
        </li>
    </ul>

    <div class="tab-content" id="nichosTabsContent">
        <div class="tab-pane fade show active" id="table-view" role="tabpanel">
            @include('nichos.partials.tabla')
        </div>

        <div class="tab-pane fade" id="map-view" role="tabpanel">
            @include('nichos.partials.mapa')
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('#calle-select').change(function() {
        const calle = $(this).val();
        $('.nicho-cell').each(function() {
            const cellCalle = $(this).data('calle');
            $(this).toggle(!calle || cellCalle === calle);
        });
        $('.avenida-row').each(function() {
            $(this).toggle($(this).find('.nicho-cell:visible').length > 0);
        });
    });
});
</script>
@endpush
