@section('title', __('Modelos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-4">
                <div class="cardPrin">
                    <div class="cardPrin-header">
                        <div>Modelos</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Modelo">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                    <div class="cardPrin-body">
                        @include('livewire.modelos.modals')
                        <div class="table-responsive" style="overflow-y: auto; height: 75vh; min-height: 50vh;">
                            <table class="table tabBase">
                                <thead class="thead" style="position: sticky; top: 0; z-index: 1;">
                                    <tr>
                                        <th>Linea</th>
                                        <th>Modelo</th>
                                        <th>Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    function bolitaEstado($estatus) {
                                        if ($estatus == 'revision') return '<span class="bolita bolita-rojo"></span>';
                                        if ($estatus == 'optimizado') return '<span class="bolita bolita-azul"></span>';
                                        if ($estatus == 'publicado') return '<span class="bolita bolita-verde"></span>';
                                        return  '<span class="bolita bolita-red"></span>';
                                    }
                                @endphp                                    
                                    @forelse($modelos as $row)
                                        <tr>
                                            <td>{{ $row->Linea->Marca->marca }} {{ $row->Linea->linea }}</td>
                                            <td wire:click="elegir({{ $row->id }})"
                                                style="cursor: pointer; user-select: none;">
                                                {!! bolitaEstado($row->estatus) !!} {{ $row->modelo }} 
                                            </td>
                                            <td wire:click="elegir({{ $row->id }})"
                                                style="cursor: pointer; user-select: none;">
                                                @if ($row->foto)
                                                    @php
                                                        $marca = $row->Linea->Marca->marca;
                                                        $ruta = 'storage/modelos/' . $marca . '/' . $row->foto;
                                                    @endphp
                                                    <img src="{{ asset($ruta) }}" alt="foto"
                                                        style="max-width: 100%; max-height: 50px; object-fit: contain;">
                                                @else
                                                    <span>Sin foto</span>
                                                @endif
                                            </td>
                                            <td width="120">
                                                <div class="d-flex justify-content-around align-items-center gap-1">
                                                    @if($row->fichaTecnica)
                                                        <a href="{{ asset('storage/' . $row->rutaFicha . '/' . $row->fichaTecnica) }}" 
                                                        target="_blank" 
                                                        class="bot botNaranja text-decoration-none d-flex align-items-center justify-content-center" 
                                                        title="Ver Ficha Técnica"
                                                        style="background-color: #dc3545;">
                                                            <i class="bi bi-file-earmark-pdf-fill text-white"></i>
                                                        </a>
                                                    @endif                                                    
                                                    <button wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                        title="Editar">
                                                        <i class="bi-pencil-square"></i>
                                                    </button>
                                                    <button wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                        onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                        <i class="bi-trash3-fill"></i>
                                                    </button>
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
                                {{ $modelos->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @livewire('modelosmats', ['IdModelo' => $selected_id2], key('modelosmats-' . $selected_id2))
            </div>
        </div>
    </div>
</div>
