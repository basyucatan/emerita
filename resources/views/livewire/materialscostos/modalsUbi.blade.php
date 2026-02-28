@if ($verModalUbi)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            Editar Ubicación
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 350px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif

                            <div class="form-group">
                                <label for="zona" class="etiBase">Zona</label>
                                <input wire:model.defer="ubi.zona" type="text" class="inpBase" id="zona">
                                @error('zona')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pasillo" class="etiBase">Pasillo</label>
                                <input wire:model.defer="ubi.pasillo" type="text" class="inpBase" id="pasillo">
                                @error('pasillo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="anaquel" class="etiBase">Anaquel</label>
                                <input wire:model.defer="ubi.anaquel" type="text" class="inpBase" id="anaquel">
                                @error('anaquel')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="posicion" class="etiBase">Posición</label>
                                <input wire:model.defer="ubi.posicion" type="text" class="inpBase" id="posicion">
                                @error('posicion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>

                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="saveUbi" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif