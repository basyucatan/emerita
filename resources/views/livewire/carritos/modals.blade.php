@if ($verModalDatos)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            Captura tus datos para el pedido
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="etiBase">Distrito</label>
                                    <select class="inpBase" wire:model="IdDistrito" wire:change="elegirDepto">
                                        <option value=""></option>
                                        @foreach ($distritos as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>      
                                <div class="col-12 col-md-6">
                                    <label class="etiBase">Telefono</label>
                                    <input wire:model="telefono" type="text" class="inpBase" id="telefono">
                                    @error('telefono')<span class="error text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="etiBase">Nombre</label>
                                    <input wire:model="nombre" type="text" class="inpBase" id="nombre">
                                    @error('nombre')<span class="error text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botNegro">Cerrar</a>
                        <a wire:click.prevent="savePedido()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
