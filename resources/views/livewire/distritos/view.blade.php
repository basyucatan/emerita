@section('title', __('Distritos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Distritos</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Distrito">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.distritos.modals')
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
                                    <th>Distrito</th>
                                    <th>Panel</th>
                                    <th>Orden</th>
                                    <th>Direccion</th>
                                    <th>Foto</th>
                                    <th>Fechahple</th>
                                    <th>Fechahest</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distritos as $row)
                                    <tr>
                                        <td>{{ $row->distrito }}</td>
                                        <td>{{ $row->panel }}</td>
                                        <td>{{ $row->orden }}</td>
                                        <td>{{ $row->direccion }}</td>
                                        <td>{{ $row->foto }}</td>
                                        <td>{{ $row->fechaHPle }}</td>
                                        <td>{{ $row->fechaHEst }}</td>
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
                            {{ $distritos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
