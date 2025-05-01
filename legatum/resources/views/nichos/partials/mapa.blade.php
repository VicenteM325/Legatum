@include('nichos.partials.estilos')

<div class="nicho-map-container">
    @foreach($avenidasUnicas as $avenida)
        <div class="avenida-row" data-avenida="{{ $avenida }}">
            <div class="avenida-label">{{ $avenida }}</div>
            <div class="nicho-row">
                @foreach($callesUnicas as $calle)
                    @php
                        $nicho = $nichos->where('avenida', $avenida)->where('calle', $calle)->first();
                    @endphp
                    <div class="nicho-cell" data-calle="{{ $calle }}" data-avenida="{{ $avenida }}">
                        @if($nicho)
                            <div class="nicho {{ $nicho->estado }} {{ $nicho->es_historico ? 'historico' : '' }}"
                                 data-toggle="tooltip"
                                 title="Código: {{ $nicho->codigo }} 
                                        Tipo: {{ $nicho->tipo }}
                                        Estado: {{ ucfirst($nicho->estado) }}
                                        {{ $nicho->es_historico ? 'Histórico' : 'Común' }}">
                                <span class="nicho-code">{{ $nicho->codigo }}</span>
                                <div class="nicho-actions">
                                    <a href="{{ route('nichos.edit', $nicho) }}" class="btn btn-xs btn-warning">✏️</a>
                                </div>
                            </div>
                        @else
                            <div class="nicho empty" data-toggle="tooltip" title="Ubicación disponible: Avenida {{ $avenida }}, Calle {{ $calle }}">
                                <span class="nicho-code">+</span>
                                <div class="nicho-actions">
                                    <a href="{{ route('nichos.create') }}?avenida={{ $avenida }}&calle={{ $calle }}" 
                                       class="btn btn-xs btn-success">➕</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<!-- Leyenda -->
<div class="legend mt-4">
    <h5>Estado:</h5>
    <div class="legend-item"><span class="legend-color disponible"></span> Disponible</div>
    <div class="legend-item"><span class="legend-color ocupado"></span> Ocupado</div>
    <div class="legend-item"><span class="legend-color historico"></span> Histórico</div>
</div>
