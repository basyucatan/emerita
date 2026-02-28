@section('title', __('Traspasosdets'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">                
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Materiales # {{ $compra->id ?? '' }}</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.traspasosdets.modals')
                    <div class="table-responsive" style="overflow-y: auto; height: 55vh; min-height: 10vh;">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cant</th>
                                    <th>U</th>
                                    <th>Referencia</th>
                                    <th>Material</th>
                                    <th>Color</th>
                                    <th>Acciones</th>
                                    <th>Valor/U</th>
                                    <th>Importe</th>
                                    <th>Imp.Pesos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($traspasosdets as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->cantidad }}</td>
                                        <td>{{ $row->Unidad }}</td>
                                        <td>{{ $row->Referencia }}</td>
                                        <td>{{ $row->Material }}</td>
                                        <td>
                                            @if($row->Color)
                                                <span class="cuadroColor" title="{{ $row->Color->color }}"
                                                style="background-color: {{ $row->Color->colorRgba }}"></span>
                                            @else
                                                <span class="cuadroColor sinColor" style="color: red;">✕</span>
                                            @endif
                                        </td>                                        
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                @if ($estatusPadre === 'Abierto')
                                                    <a wire:click="edit({{ $row->id }})" class="bot botNaranja"><i class="bi-pencil-square"></i></a>
                                                    <a wire:click="duplicar({{ $row->id }})" class="bot botVerde"><i class="bi-files"></i></a>
                                                    <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                        onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                        <i class="bi-trash3-fill"></i>
                                                    </a>
                                                @else
                                                    <span class="text-muted small">🔒 Cerrado</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="text-align: right;"> {{number_format($row->valorU,2) }} {{ $row->Valores['simbolo'] }}</td>
                                        <td style="text-align: right;">{{ number_format($row->Valores['importe'], 2) }}</td>
                                        <td style="text-align: right;">{{ number_format($row->Valores['importeMXN'], 2) }}</td>
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
