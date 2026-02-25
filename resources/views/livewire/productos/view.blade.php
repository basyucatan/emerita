@section('title', __('Productos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div>
                        Productos
                    </div>
                    <div>
                        <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar">
                    </div>
                    <div>
                        <button class="bot botVerde" wire:click="create" title="Nuevo Producto">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>                   
                    </div>                
                </div>
                <div class="cardPrin-body">
                    @include('livewire.productos.modals')
                    <div class="row g-1">
                        @forelse($productos as $row)
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="cardSec">
                                    <div class="cardSec-header">
                                        {{ $row->producto }}
                                    </div>
                                    <div class="cardSec-body">
                                        {{ $row->codigo }} | {{ $row->foto }} | {{ $row->linkCMSG }} | {{ $row->producto }} | {{ $row->IdClase }} | {{ $row->precioU }} | {{ $row->precioN }} | {{ $row->costoU }} | {{ $row->stockMin }} | {{ $row->pDescuento }} | {{ $row->activo }} | {{ $row->obs }}
                                    </div>
                                    <div class="cardSec-footer d-flex justify-content-end gap-2">
                                        <button wire:click="edit({{ $row->id }})"
                                                class="bot botNaranja"
                                                title="Editar">
                                            <i class="bi-pencil-square"></i>
                                        </button>
                                        <button wire:click="destroy({{ $row->id }})"
                                                class="bot botRojo"
                                                onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()">
                                            <i class="bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
