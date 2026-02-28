@if ($verModalModelosmat)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Material' : 'Crear Material' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-md-6">
                                    <label for="cantidad" class="etiBase">Cantidad</label>
                                    <input wire:model="cantidad" type="text" class="inpBase" id="cantidad">
                                    @error('cantidad')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdTipo" class="etiBase">Idtipo</label>
                                    <input wire:model="IdTipo" type="text" class="inpBase" id="IdTipo">
                                    @error('IdTipo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="posicion" class="etiBase">Posicion</label>
                                    <input wire:model="posicion" type="text" class="inpBase" id="posicion">
                                    @error('posicion')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="formula" class="etiBase">Formula</label>
                                    <input wire:model="formula" type="text" class="inpBase" id="formula">
                                    @error('formula')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="diferenciador" class="etiBase">Obs</label>
                                    <input wire:model="diferenciador" type="text" class="inpBase" id="diferenciador">
                                    @error('diferenciador')
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
