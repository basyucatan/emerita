@section('title', __('Compras'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Compras</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <a wire:click.prevent="create('Compras')" class="bot botVerde" title="Generar compras"><i
                                class="bi bi-diagram-3"></i></a>
                        <a wire:click.prevent="create('Compra')" class="bot botVerde" title="Generar compra individual"><i
                                class="bi bi-file-earmark-plus"></i></a>
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
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                    <th>Solicitó</th>
                                    <th>Recibió</th>
                                    <th>Presupuesto</th>
                                    <th>Marca</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    if (!function_exists('bolitaEstatus')) {
                                        function bolitaEstatus($estatus)
                                        {
                                            if ($estatus == 'Abierto') {
                                                return '<span class="bolita bolita-verde"></span>';
                                            }
                                            if ($estatus == 'Cancelado') {
                                                return '<span class="bolita bolita-amarillo"></span>';
                                            }
                                            if ($estatus == 'Cerrado') {
                                                return '<span class="bolita bolita-rojo"></span>';
                                            }
                                            return '';
                                        }
                                    }
                                @endphp
                                @forelse($traspasos as $row)
                                    <tr>
                                        <td wire:click="elegir({{ $row->id }})" style="cursor: pointer;">
                                            {!! bolitaEstatus($row->estatus) !!} {{ $row->id }}
                                        </td>
                                        <td>{{ App\Models\Util::formatFecha($row->fecha, 'D/MMM/AA') }}</td>
                                        <td>${{ number_format($row->Total, 2) }}</td>
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <a wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                    title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </a>
                                                @if ($row->estatus == 'Abierto')
                                                    <a wire:click="cerrar({{ $row->id }})" class="bot botRojo" title="recibir"
                                                        onclick="confirm('¿Estás seguro de guardar este registro? Se ingresarán los materiales al almacén !') || event.stopImmediatePropagation()">
                                                        <i class="bi-floppy"></i>
                                                    </a>
                                                @endif
                                                @if ($row->estatus == 'Cerrado')
                                                    <a wire:click="devolver({{ $row->id }})" class="bot botRojo" title="devolver"
                                                        onclick="confirm('¿Estás seguro de anular este movimiento? ') || event.stopImmediatePropagation()">
                                                        <i class="bi-arrow-repeat"></i>
                                                    </a>
                                                @endif
                                                <a wire:click="imprimir({{ $row->id }})" class="bot botVerde" title="Imprimir">
                                                    <i class="bi-printer"></i>
                                                </a>
                                                <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $row->userOri->name ?? '' }}</td>
                                        <td>{{ $row->userDes->name ?? '' }}</td>
                                        <td>
                                            {{ $row->adicionales['presupuesto'] ?? '' }}
                                            {{ $row->adicionales['tipoCEuro'] ? 'Euro: ' . $row->adicionales['tipoCEuro'] : '' }}
                                        </td>
                                        <td>{{ $row->adicionales['marca'] ?? '' }}</td>
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
                            @if (method_exists($traspasos, 'links'))
                                {{ $traspasos->links() }}
                            @endif
                        </div>

                    </div>
                    <div class="cardPrin-body">
                        <div class="row colReducida">
                            <div class="col-md-4">
                                @livewire('materialsarbol', ['nivel' => 4])
                            </div>
                            <div class="col-md-8">
                                @livewire('traspasosdets', ['IdTraspaso' => $selected_id], key('traspasosdets' . $selected_id))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
