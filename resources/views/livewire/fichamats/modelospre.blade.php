<div class="cardSec">
    <div class="cardSec-header">
        Modelos en Presupuestos
    </div>
    <div class="cardSec-body">
        <div class="table-responsive">
            <table class="table tabBase">
                <thead style="position: sticky; top: 0;">
                    <tr>
                        <th>Presup.</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modelosPres as $row)
                        <tr>
                            <td>{{ Str::words($row->presupuesto->cliente->nombre, 2, '') }}</td>
                            <td>{{ $row->consecutivo }} |{{ $row->ubicacion }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">No se encontraron datos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="float-end">
                @if($modelosPres)
                    {{ $modelosPres->links() }}
                @endif
            </div>            
        </div>        
    </div>
</div>
