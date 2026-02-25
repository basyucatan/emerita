@section('title', __('Clases'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div>
                        Clases
                    </div>
                    <div>
                        <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                    </div>
                    <div>
                        <button class="bot botVerde" wire:click="create" title="Nuevo Clase">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.clases.modals')
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
                                    <th>Clase</th>
                                    <th>Orden</th>
                                    <th>Depto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clases as $row)
                                    <tr>
                                        <td>{{ $row->clase }}</td>
                                        <td>{{ $row->orden }}</td>
                                        <td>{{ $row->depto }}</td>
                                        <td width="60">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <button wire:click="edit({{ $row->id }})"
                                                    class="bot botNaranja "title="Editar">
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
                            {{ $clases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
