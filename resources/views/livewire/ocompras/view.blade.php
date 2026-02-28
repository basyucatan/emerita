@section('title', __('Ocompras'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div>
                        Ocompras
                    </div>
                    <div>
                        <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                    </div>
                    <div>
                        <button class="bot botVerde" wire:click="create" title="Nuevo Ocompra">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>                   
                    </div>                
                </div>
                <div class="cardPrin-body">
                    @include('livewire.ocompras.modals')
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
								<th>Iddivision</th>
								<th>Idproveedor</th>
								<th>Iduser</th>
								<th>Idobra</th>
								<th>Idcondpago</th>
								<th>Idcondflete</th>
								<th>Fechahsol</th>
								<th>Fechaerec</th>
								<th>Pordescuento</th>
								<th>Concepto</th>
								<th>Estatus</th>
								<th>Adicionales</th>
<th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @forelse($ocompras as $row)
                                    <tr>
                                        
								<td>{{ $row->IdDivision }}</td>
								<td>{{ $row->IdProveedor }}</td>
								<td>{{ $row->IdUser }}</td>
								<td>{{ $row->IdObra }}</td>
								<td>{{ $row->IdCondPago }}</td>
								<td>{{ $row->IdCondFlete }}</td>
								<td>{{ $row->fechaHSol }}</td>
								<td>{{ $row->fechaERec }}</td>
								<td>{{ $row->porDescuento }}</td>
								<td>{{ $row->concepto }}</td>
								<td>{{ $row->estatus }}</td>
								<td>{{ $row->adicionales }}</td>

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
                            {{ $ocompras->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
