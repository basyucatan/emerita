@section('title', __('Distritosservs'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Distritosservs</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Distritosserv">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.distritosservs.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
								<th>Iddistrito</th>
								<th>Idservicio</th>
								<th>Idcomite</th>
								<th>Idcomitecan</th>
								<th>Servidor</th>
								<th>Telefono</th>
								<th>Asamblea1</th>
								<th>Asamblea2</th>
<th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distritosservs as $row)
                                    <tr>
								<td>{{ $row->IdDistrito }}</td>
								<td>{{ $row->IdServicio }}</td>
								<td>{{ $row->IdComite }}</td>
								<td>{{ $row->IdComiteCan }}</td>
								<td>{{ $row->servidor }}</td>
								<td>{{ $row->telefono }}</td>
								<td>{{ $row->asamblea1 }}</td>
								<td>{{ $row->asamblea2 }}</td>
                                <td width="120">
                                        <div class="d-flex justify-content-around align-items-center gap-1">
                                            <button wire:click="edit({{ $row->id }})" class="bot botNaranja" title="Editar">
                                                <i class="bi-pencil-square"></i>
                                            </button>
                                            <button wire:click="destroy({{ $row->id }})" class="bot botRojo" onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                <i class="bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="100%" class="text-center">No se encontraron datos.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $distritosservs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
