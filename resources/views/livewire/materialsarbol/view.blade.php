@section('title', __('MaterialsArbol'))
<div class="container-fluid">
    <div class="accordion" id="panelMateriales">
        <div class="accordion-item">
            <div class="cardSec-header" style="grid-template-columns: 30% 30% 35%;">
                <div>📦 Materiales</div>
                <input wire:model.live="keyWord" type="text" class="inpSolo" placeholder="Buscar..."
                    style="max-width:180px;">
                <div class="d-flex justify-content-around">
                    <a wire:click="resetBusqueda" class="bot botVerde">X</a>
                    <a wire:click="abrirCrear('Marca')" class="btnIcono">➕🧿</a>
                    <a class="bot botNegro px-2" wire:click="$toggle('mostrarRaiz')">
                        {{ $mostrarRaiz ? '🔼' : '🔽' }}
                    </a>
                </div>
            </div>

            <div class="accordion-collapse collapse {{ $mostrarRaiz ? 'show' : '' }}">
                <div class="accordion-body" style="overflow-y: auto; height: 34vh; min-height: 200px;">
                    <ul class="list-unstyled">
                        @foreach ($arbol as $raiz)
                            @include('livewire.materialsarbol.nodo', [
                                'nodo' => $raiz,
                                'nivelActual' => 1,
                                'expandido' => $expandido,
                            ])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Crear --}}
    @if ($modalCrear)
        <div class="modal show d-block">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <h5>Nuevo {{ $tipoNodo }}</h5>

                    @foreach ($camposCrear as $campo => $meta)
                        @if ($meta['visible'])
                            <div class="mb-2">
                                <label>{{ $meta['label'] }}</label>

                                @if (($meta['type'] ?? 'text') === 'select')
                                    <select wire:model="formData.{{ $campo }}" class="form-control">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($meta['options'] ?? [] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" wire:model="formData.{{ $campo }}" class="form-control"
                                        placeholder="{{ $meta['label'] }}">
                                @endif
                            </div>
                        @endif
                    @endforeach

                    <div class="mt-3 text-end">
                        <button wire:click="guardarElemento" class="btn btn-primary">Guardar</button>
                        <button wire:click="$set('modalCrear', false)" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal Eliminar --}}
    @if ($modalEliminar)
        <div class="modal show d-block">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <h5>Eliminar {{ $tipoNodo }}</h5>
                    <p>¿Seguro que deseas eliminar este elemento?</p>
                    <div class="mt-3 text-end">
                        <button wire:click="eliminarElemento" class="btn btn-danger">Eliminar</button>
                        <button wire:click="$set('modalEliminar', false)" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
