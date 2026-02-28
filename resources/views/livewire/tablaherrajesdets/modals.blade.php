@if ($verModalTablaherrajesdet)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar ' : 'Crear ' }} {{ $material->material}}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-md-4">
                                    <label for="cantidad" class="etiBase">Cantidad</label>
                                    <input wire:model="cantidad" type="number" step="1"class="inpBase" id="cantidad">
                                    @error('cantidad')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="rangoMenor" class="etiBase">Rango Mínimo</label>
                                    <input wire:model="rangoMenor" type="number" step="100" class="inpBase" id="rangoMenor">
                                    @error('rangoMenor')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="rangoMayor" class="etiBase">Rango Máximo</label>
                                    <input wire:model="rangoMayor" type="number" step="100" class="inpBase" id="rangoMayor">
                                    @error('rangoMayor')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="factorExtra" class="etiBase">Factor Extra</label>
                                    <input wire:model="factorExtra" type="number" step="100" class="inpBase" id="factorExtra">
                                    @error('factorExtra')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
