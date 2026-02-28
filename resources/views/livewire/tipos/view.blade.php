@section('title', __('Tipos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Tipos</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Tipo">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.tipos.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
								<th>Tipo</th>
								<th>Orden</th>
<th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tipos as $row)
                                    <tr>
								<td>{{ $row->tipo }}</td>
								<td>{{ $row->orden }}</td>
                                <td width="120">
                                        <div class="d-flex justify-content-around align-items-center gap-1">
                                            <a wire:click="edit({{ $row->id }})" class="bot botNaranja" title="Editar">
                                                <i class="bi-pencil-square"></i>
                                            </a>
                                            <a wire:click="destroy({{ $row->id }})" class="bot botRojo" onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                <i class="bi-trash3-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="100%" class="text-center">No se encontraron datos.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $tipos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
