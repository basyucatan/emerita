<div class="cardSec">
    <div class="cardSec-header">
        Reglas
    </div>
    <div class="cardSec-body">
        <div class="table-responsive">
            <table class="table tabBase">
                <thead style="position: sticky; top: 0;">
                    <tr>
                        <th>Linea</th>
                        <th>Material</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reglas as $row)
                        <tr>
                            <td>{{ $row->Material->Linea->linea}}</td>
                            <td>{{ $row->Material->material}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">No se encontraron datos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- <div class="float-end">
                @if($modelosPres)
                    {{ $modelosPres->links() }}
                @endif
            </div>             --}}
        </div>        
    </div>
</div>
