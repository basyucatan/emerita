@section('title', __('Reglas'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardSec">
                <div class="cardSec-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Reglas</div>                       
                        <div>
                            <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                        </div>                         
                    </div>
                </div>
                <div class="cardSec-body">
                    <div id="dropzone-material" class="soltar" ondragover="handleDragOver(event)"
                        ondrop="handleDrop(event)" data-accepts="material" data-vista="reglas">
                        📐->📦 Aquí puedes cargar el material a generar por la regla!
                    </div>
                    @include('livewire.reglas.modals')
                    <div class="table-responsive" style="overflow-y: auto; height: 20vh; min-height: 10vh;">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    <th>Material a Generar</th>
                                    <th>Base</th>
                                    <th>Efecto</th>
                                    <th>Factor</th>
                                    <th>Descuento</th>
                                    <th>Línea</th>
                                    <th>gVidrio</th>
                                    <th>Exclusivo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reglas as $row)
                                    <tr>
                                        <td>{{ $row->MaterialRel->material }}</td>
                                        <td>{{ $row->baseCalculo }}</td>
                                        <td>{{ $row->efectoCalculo }}</td>
                                        <td>{{ $row->factor }}</td>
                                        <td>{{ $row->descuento }}</td>
                                        <td>{{ $row->Linea->linea ?? '' }}</td>
                                        <td>{{ $row->Vidrio->grosor ?? ''}}</td>
                                        <td>{{ $row->Tipo->tipo ?? '' }}</td>
                                        <td width="120">
                                            <div class="d-flex justify-content-around align-items-center gap-1">
                                                <button wire:click="edit({{ $row->id }})" class="bot botEdit"
                                                    title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </button>
                                                <button wire:click="destroy({{ $row->id }})" class="bot botDelete"
                                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash3-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">No se encontraron reglas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $reglas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
