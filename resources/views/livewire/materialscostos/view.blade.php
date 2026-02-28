@section('title', __('Materialscostos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardSec">
                <div class="cardSec-header">
                        <div>Costos</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                        </div>
                        <button class="bot botVerde" wire:click="create"><i class="bi bi-file-earmark-plus"></i></button>
                        <button class="bot botVerde" wire:click="variantes"><i class="bi-cash"></i></button>
                        <button class="bot botVerde" wire:click="editOriDes">Origen🡆Destino</button>
                        <button class="bot botVerde" wire:click="editArbolDes">Arbol🡆Destino</button>
                        <button class="bot botVerde" wire:click="ubicacionesPDF">🖨️ Ubis</button>        
                        {{-- <a class="bot botVerde" wire:click="phpArray"><i class="bi-calculator"></i></a> --}}
                </div>
                <div class="cardSec-body">
                    @include('livewire.materialscostos.modals')
                    @include('livewire.materialscostos.modalsUbi')
                    @include('livewire.materialscostos.modalsArbolDes')
                    @include('livewire.materialscostos.modalsOriDes')
                    <div class="table-responsive" style="overflow-y: auto; 
                        height: {{ $padre === 'materials' ? '20vh' : '60vh' }}; min-height: 100px;">
                        <table class="table tabBase">
                            <thead style="position: sticky; top: 0;">
                                <tr>
                                    <th>#</th>
                                    <th>Color</th>
                                    <th>Ref Prov.</th>
                                    <th>Ref Bodega</th>
                                    {{-- <th>Dirección</th> --}}
                                    <th>Vidrio</th>
                                    <th>Barra</th>
                                    <th>Panel</th>
                                    <th style="text-align: right;">Costo</th>
                                    <th style="text-align: center;">Moneda</th>
                                    <th style="text-align: center;">$ MXN</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materialscostos as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($row->Color)
                                                <span class="cuadroColor" style="background-color: {{ $row->Color->colorRgba }}"></span>
                                                {{ $row->Color->color }}
                                            @else
                                                <span class="cuadroColor sinColor" style="color: red;">✕</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->referencia }}</td>
                                        <td wire:click="editUbi({{ $row->id }})" style="cursor: pointer; user-select: none;">
                                            {{ $row->UbiCodificada }}
                                        </td>
                                        {{-- <td>{{ $row->direccion }}</td> --}}
                                        <td>
                                            @if ($row->Vidrio)
                                                {{ $row->Vidrio->vidrio }} {{ $row->Vidrio->grosor }} mm
                                            @endif
                                        </td>
                                        <td>{{ $row->Barra->descripcion ?? null }}</td>
                                        <td>{{ $row->Panel->panel ?? null }}</td>
                                        <td style="text-align: right;">{{ App\Models\Util::Dinero($row->costo, 2) }}
                                        </td>
                                        <td style="text-align: center;">{{ $row->Moneda->abreviatura ?? null }}</td>
                                        <td>{{  number_format($row->valores['valorURealMXN'] ?? '', 2) }}</td>
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <a wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                    title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </a>
                                                <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash3-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">No se encontraron datos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
