@section('title', __('Movinventarios'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Movimiento de Inventarios</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Movinventario">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.movinventarios.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>Fechah</th>
                                    <th>DatosAd</th>
                                    <th>Envía</th>
                                    <th>Recibe</th>
                                    <th>Tipo</th>
                                    <th>Referencia</th>
                                    <th>Material</th>
                                    <th>DeptoOri</th>
                                    <th>DeptoDes</th>
                                    <th>Cantidad</th>
                                    <th>Valoru</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($movinventarios as $row)
                                    <tr>
                                        <td>{{ $row->fechaHora }}</td>
                                        <td style="color: red;">
                                            {{ is_array($row->adicionales) ? json_encode($row->adicionales, JSON_UNESCAPED_UNICODE) : $row->adicionales }}
                                        </td>
                                        <td>{{ $row->userOri->name ?? '' }}</td>
                                        <td>{{ $row->userDes->name ?? '' }}</td>
                                        <td>{{ $row->tipo }}</td>
                                        <td>{{ $row->materialscosto->id }}</td>
                                        <td>{{ $row->materialscosto->referencia }}</td>
                                        <td>{{ $row->materialscosto->material->material }}</td>
                                        <td>{{ $row->deptoOri->depto ?? '' }}</td>
                                        <td>{{ $row->deptoDes->depto ?? '' }}</td>
                                        <td>{{ $row->cantidad }}</td>
                                        <td>{{ $row->valorU }}</td>
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
                        <div class="float-end">
                            {{ $movinventarios->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
