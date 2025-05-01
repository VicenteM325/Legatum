<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Calle</th>
                <th>Avenida</th>
                <th>Estado</th>
                <th>Es Histórico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nichos as $nicho)
                <tr>
                    <td>{{ $nicho->codigo }}</td>
                    <td>{{ $nicho->tipo }}</td>
                    <td>{{ $nicho->calle }}</td>
                    <td>{{ $nicho->avenida }}</td>
                    <td>
                        <span class="badge 
                            @if($nicho->estado == 'disponible') badge-success
                            @elseif($nicho->estado == 'ocupado') badge-danger
                            @elseif($nicho->estado == 'reservado') badge-warning
                            @endif">
                            {{ ucfirst($nicho->estado) }}
                        </span>
                    </td>
                    <td>{{ $nicho->es_historico ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('nichos.show', $nicho) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('nichos.edit', $nicho) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('nichos.destroy', $nicho) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
