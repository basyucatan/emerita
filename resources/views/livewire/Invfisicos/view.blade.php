@section('title', __('InvFisicos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Inv. Fisico</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create('InvFisico')" title="Nuevo Traspaso">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <a wire:click="getEstatusFiltro('{{ $queVer === 'Abierto' ? 'Cerrado' : 'Abierto' }}')"
                        class="bot {{ $queVer === 'Abierto' ? 'botVerde' : 'botRojo' }} ms-1"
                        title="{{ $queVer === 'Abierto' ? 'Mostrar Cerrados' : 'Mostrar Abiertos' }}">
                            <i class="bi-eye"></i>
                            <i class="{{ $queVer === 'Abierto' ? 'bi-door-open' : 'bi-door-closed' }}"></i>
                        </a>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.traspasos.modals')
                    <div class="table-responsive" style="overflow-y: auto; height: 10vh; min-height: 100px;">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acciones</th>
                                    <th>Fecha</th>
                                    <th>Emite</th>
                                    <th>Recibe</th>
                                    <th>Depto Destino</th>
                                    <th>Adicionales</th>
                                    <th>Estatus</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($traspasos as $row)
                                    <tr>
                                        <td wire:click="elegir({{ $row->id }})" style="cursor: pointer;">
                                            {{ $row->id }}
                                        </td>
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                @if ($row->estatus == 'Abierto')
                                                    <a wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                        title="Editar">
                                                        <i class="bi-pencil-square"></i>
                                                    </a>
                                                    <a wire:click="cerrar({{ $row->id }})" class="bot botVerde"
                                                    onclick="confirm('¿Estás seguro de guardar este registro? Se harán los movimientos' + 
                                                    ' al inventario y ya no se podrá editar') || event.stopImmediatePropagation()">
                                                    <i class="bi-floppy"></i>
                                                    </a>
                                                    <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                        onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                        <i class="bi-trash3-fill"></i>
                                                    </a>
                                                @endif
                                                @if ($row->estatus == 'Cerrado')
                                                    <a wire:click="devolver({{ $row->id }})" class="bot botVerde"
                                                        title="Editar">
                                                        <i class="bi-pencil-square"></i>
                                                    </a>
                                                @endif                                                
                                            </div>
                                        </td>                                        
                                        <td>{{ App\Models\Util::formatFecha($row->fecha, 'D/MMM/AA') }}</td>
                                        <td>{{ $row->userOri->name ?? ''}}</td>
                                        <td>{{ $row->userDes->name ?? '' }}</td>
                                        <td>{{ $row->DeptoDes->depto ?? null }}</td>
                                        <td>
                                            {{ $row->adicionales['tipoCEuro'] ? 'Euro: ' . $row->adicionales['tipoCEuro'] : '' }}
                                        </td>                                        
                                        <td>{{ $row->estatus }}</td>
                                        <td>{{ $row->adicionales['obs'] ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">No se encontraron datos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $traspasos->links() }}
                        </div>
                    </div>
                    <div class="cardPrin-body">
                        <div class="row">
                            <div class="col-md-4">
                                @livewire('materialsarbol', ['nivel' => 4])                                
                            </div>
                            <div class="col-md-8">
                                @livewire('traspasosdets', ['IdTraspaso' => $selected_id]
                                , key('traspasosdets' . $selected_id))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
