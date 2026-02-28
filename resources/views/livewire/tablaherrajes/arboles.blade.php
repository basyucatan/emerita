<div class="cardSec">
    <div class="cardSec-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>Tabla de Herrajes</div>
            <div>
                <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
            </div>
            <div class="bot botVerde" wire:click="create" title="Nuevo Tablaherraje">
                <i class="bi bi-file-earmark-plus"></i>
            </div>
        </div>
    </div>
    <div class="cardSec-body">
        @include('livewire.tablaherrajes.modals')                              
        <div class="table-responsive" style="overflow-y: auto; height: 35vh; min-height: 150px;">
            <table class="table tabBase">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Linea</th>
                        <th>Pos</th>
                        <th>Tabla</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tablaherrajes as $row)
                        <tr wire:click="elegir({{ $row->id }})"
                            style="cursor: pointer; user-select: none;">
                            <td>{{ $row->Linea->Marca->marca }}</td>
                            <td>{{ $row->Linea->linea }}</td>
                            <td>{{ substr($row->posicion, 0, 1) }}</td>
                            <td>
                                {{ $row->tablaHerraje }}
                            </td>
                            <td width="80">
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
@livewire('materialsarbol', ['nivel' => 3, 'IdClase' => 3, ], 
key('materialsarbol-' . $selected_id) )