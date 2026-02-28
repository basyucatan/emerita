<div class="table-responsive" style="overflow-y: auto; height: 35vh; min-height: 150px;">
    <table class="table tabBase">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Línea</th>
                <th>Modelo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tablasdeps as $row)
                <tr>
                    <td>{{ $row->linea->marca->marca }}</td>
                    <td>{{ $row->linea->linea }}</td>
                    <td>{{ $row->modelo }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center">No hay modelos vinculados a este herraje.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>