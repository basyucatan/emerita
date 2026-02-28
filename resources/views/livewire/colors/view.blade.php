@section('title', __('Colors'))

<div class="cardPrin">
    <div class="cardPrin-header d-flex justify-content-between align-items-center">
        <div>
            Colores
        </div>
        <input wire:model='keyWord' type="text" class="inpSolo md-4" name="search" id="search" placeholder="Buscar">
        <button class="btn btn-sm btn-info" wire:click="create">Nuevo</button>
    </div>

    <div class="cardPrin-body">
        @include('livewire.colors.modals')

        <div class="row">
            @foreach ($colors as $colorable => $group)
                <div class="col-12 col-md-4">
                    <div class="cardSec h-100">
                        <div class="cardSec-header fw-bold">
                            {{ $group->first()->colorable->colorable ?? 'Sin Clase' }}
                        </div>
                        <div class="cardSec-body p-0">
                            <div class="table-responsive" style="overflow-y: auto; height: 100px; max-height: 150px;">
                                <table class="table tabBase mb-0">
                                    <thead class="thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Color</th>
                                            <th>Herraje</th>
                                            <th style="text-align: center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->color }}</td>
                                                <td>
                                                    <div class="cuadroColor" style="background-color: {{ $row->colorRgba }};"></div>
                                                </td>
                                                <td>
                                                    @if ($row->colorHerraje)
                                                        <div class="cuadroColor" 
                                                            style="background-color: {{ $row->colorHerraje->colorHex }};"
                                                            title="{{ $row->colorHerraje->color ?? '' }}">
                                                        </div>
                                                    @endif
                                                </td>
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($colors->isEmpty())
            <p class="text-center mt-4">Sin datos disponibles</p>
        @endif
    </div>
</div>
