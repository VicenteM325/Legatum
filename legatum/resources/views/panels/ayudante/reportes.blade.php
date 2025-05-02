@extends('adminlte::page')

@section('title', 'Reportes de Ayudante')

@section('content_header')
    <h1 class="text-center"><i class="fas fa-filter mr-2"></i> Reportes con Filtros</h1>
@stop

@section('content')
<form method="GET" action="{{ route('ayudante.reportes') }}">
    <div class="row mb-3">
        <div class="col-md-3">
            <label>Fecha desde</label>
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Fecha hasta</label>
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label>Estado de Nicho</label>
            <select name="estado_nicho" class="form-control">
                <option value="">-- Todos --</option>
                <option value="ocupado" {{ request('estado_nicho') == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                <option value="disponible" {{ request('estado_nicho') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="en proceso de exhumación" {{ request('estado_nicho') == 'en proceso de exhumación' ? 'selected' : '' }}>En proceso de...</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>¿Histórico?</label>
            <select name="historico" class="form-control">
                <option value="">-- Todos --</option>
                <option value="1" {{ request('historico') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('historico') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>Estado de Pago</label>
            <select name="estado_pago" class="form-control">
                <option value="">-- Todos --</option>
                <option value="pagado" {{ request('estado_pago') == 'pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="pendiente" {{ request('estado_pago') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            </select>
        </div>
    </div>
    <button class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
</form>

<hr>

@if($resultados->count())
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Nicho</th>
                <th>Estado</th>
                <th>Histórico</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $nicho)
            <tr>
                <td>{{ $nicho->codigo }}</td>
                <td>
                    <span class="badge bg-{{ $nicho->estado === 'ocupado' ? 'primary' : 'success' }}">
                        {{ ucfirst($nicho->estado) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $nicho->es_historico ? 'warning' : 'secondary' }}">
                        {{ $nicho->es_historico ? 'Sí' : 'No' }}
                    </span>
                </td>
                <td>{{ $nicho->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($resultados->count())
    <div class="card mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title"><i class="fas fa-chart-pie"></i> Gráfico de Nichos Filtrados</h3>
        </div>
        <div class="card-body">
            <canvas id="nichoChartFiltrado"></canvas>
        </div>
    </div>
    @endif
@else
    <p class="text-muted">No hay resultados con los filtros seleccionados.</p>
@endif

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxFiltrado = document.getElementById('nichoChartFiltrado').getContext('2d');
        const chartFiltrado = new Chart(ctxFiltrado, {
            type: 'bar',
            data: {
                labels: ['Ocupados', 'Disponibles'],
                datasets: [{
                    label: 'Cantidad',
                    data: [{{ $ocupadosFiltrados }}, {{ $disponiblesFiltrados }}],
                    backgroundColor: ['#007bff', '#28a745'],
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
@endsection

@stop
