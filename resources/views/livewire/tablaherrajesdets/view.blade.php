@section('title', __('Tablaherrajesdets'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardSec" style="overflow-y: auto; height: 62vh; min-height: 200px;">
                <div class="cardSec-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Herrajes para {{$tablaHerraje}}</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                    </div>
                </div>
                <div class="cardSec-body">
                    @include('livewire.tablaherrajesdets.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Material</th>
                                    <th>Rango Menor</th>
                                    <th>Rango Mayor</th>
                                    <th>factor Extra</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tablaherrajesdets as $row)
                                    <tr>
                                        <td>{{ $row->cantidad }}</td>
                                        <td>{{ $row->Material->material }}</td>
                                        <td>{{ $row->rangoMenor }}</td>
                                        <td>{{ $row->rangoMayor }}</td>
                                        <td>{{ $row->factorExtra }}</td>
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
