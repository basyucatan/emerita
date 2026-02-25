@section('title', __('Grupos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Grupos</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Grupo">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.grupos.modals')
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Miembros</th>
                                    <th>Direccion</th>
                                    <th>Localidad</th>
                                    <th>Tipo</th>
                                    <th>Rsg</th>
                                    <th>Clase</th>
                                    <th>Obs</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grupos as $row)
                                    <tr>
                                        <td>{{ $row->grupo }}</td>
                                        <td>{{ $row->miembros }}</td>
                                        <td>{{ $row->direccion }}</td>
                                        <td>{{ $row->localidad }}</td>
                                        <td>{{ $row->tipo }}</td>
                                        <td>{{ $row->RSG }}</td>
                                        <td>{{ $row->clase }}</td>
                                        <td>{{ $row->Obs }}</td>
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <button wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                    title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </button>
                                                <button wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash3-fill"></i>
                                                </button>
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
                            {{ $grupos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
