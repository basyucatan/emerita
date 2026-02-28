@section('title', __('Laminas'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div>
                        Laminas
                    </div>
                    <div>
                        <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                    </div>
                    <div>
                        <button class="bot botVerde" wire:click="create" title="Nuevo Lamina">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>                   
                    </div>                
                </div>
                <div class="cardPrin-body">
                    @include('livewire.laminas.modals')
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
								<th>Lamina</th>
								<th>Codigo</th>
								<th>Codigocinta</th>
								<th>Pesoml</th>
								<th>Calibre</th>
								<th>Dutil</th>
<th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @forelse($laminas as $row)
                                    <tr>
                                        
								<td>{{ $row->lamina }}</td>
								<td>{{ $row->codigo }}</td>
								<td>{{ $row->codigoCinta }}</td>
								<td>{{ $row->pesoML }}</td>
								<td>{{ $row->calibre }}</td>
								<td>{{ $row->dUtil }}</td>

                                        <td width="60">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <button wire:click="edit({{ $row->id }})"
                                                        class="bot botNaranja"
                                                        title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </button>
                                                <button wire:click="destroy({{ $row->id }})"
                                                        class="bot botRojo"
                                                        onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash3-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $laminas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
