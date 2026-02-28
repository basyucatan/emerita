@if ($verModalPanel)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Panel' : 'Crear Panel' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                            <div class="form-group">
                                <label for="panel" class="etiBase">Panel</label>
                                <input wire:model.live="panel" type="text" class="inpBase" id="panel">
                                @error('panel')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ancho" class="etiBase">Ancho (m)</label>
                                <input wire:model.live="ancho" type="text" class="inpBase" id="ancho">
                                @error('ancho')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alto" class="etiBase">Alto (m)</label>
                                <input wire:model.live="alto" type="text" class="inpBase" id="alto">
                                @error('alto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
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
