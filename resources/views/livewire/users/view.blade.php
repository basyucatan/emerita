@section('title', __('Users'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Users</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo User">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.users.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->telefono }}</td>
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
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
